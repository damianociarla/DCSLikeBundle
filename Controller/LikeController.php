<?php

namespace DCS\LikeBundle\Controller;

use DCS\LikeBundle\Model\LikeManagerInterface;
use DCS\LikeBundle\Model\ThreadManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class LikeController extends Controller
{
    public function getLinkAction(Request $request)
    {
        $permalink = $request->get('permalink');

        if (null === $id = $request->get('id', $permalink)) {
            throw new \Exception('Thread id must be set');
        }

        $securityContext = $this->get('security.context');

        if (!$this->container->getParameter('dcs_like.allow_anonymous') &&
            !$securityContext->isGranted('IS_AUTHENTICATED_FULLY')
        ) {
            return new Response();
        }

        if (null === $id) {
            $id = $request->getUri();
        }

        /** @var ThreadManagerInterface $threadManager */
        $threadManager = $this->get('dcs_like.manager.thread');

        if (null === $thread = $threadManager->findOneById($id)) {
            $thread = $threadManager->create($id);
            $thread->setPermalink($permalink);

            $threadManager->save($thread);
        }

        $isLiked = false;

        if (null !== $user = $securityContext->getToken()->getUser()) {
            /** @var LikeManagerInterface $likeManager */
            $likeManager = $this->get('dcs_like.manager.like');

            if (null !== $like = $likeManager->findOneByThreadAndUser($thread, $user)) {
                $isLiked = true;
            }
        }

        return $this->render('DCSLikeBundle:Like:link.html.twig', array(
            'thread' => $thread,
            'isLiked' => $isLiked,
        ));
    }

    public function likeAction(Request $request, $id)
    {
        $securityContext = $this->get('security.context');

        if (!$this->container->getParameter('dcs_like.allow_anonymous') &&
            !$securityContext->isGranted('IS_AUTHENTICATED_FULLY')
        ) {
            throw new AccessDeniedException();
        }

        /** @var ThreadManagerInterface $threadManager */
        $threadManager = $this->get('dcs_like.manager.thread');

        if (null === $thread = $threadManager->findOneById($id)) {
            throw new NotFoundHttpException();
        }

        /** @var LikeManagerInterface $likeManager */
        $likeManager = $this->get('dcs_like.manager.like');

        $like = null;

        if (null !== $user = $securityContext->getToken()->getUser()) {
            $like = $likeManager->findOneByThreadAndUser($thread, $user);
        }

        if (null === $like) {
            $like = $likeManager->create($thread);
            $like->setUser($user);

            $likeManager->save($like);

            $thread->setLastLikeAt(new \DateTime());
            $threadManager->patch($thread);
        }

        if ($request->isXmlHttpRequest()) {
            return $this->render('DCSLikeBundle:Like:link.html.twig', array(
                'thread' => $thread,
                'isLiked' => true,
            ));
        }

        if (null === $redirectUri = $request->headers->get('referer', $thread->getPermalink())) {
            return $this->render('@DCSLike/Like/liked.html.twig', array(
                'thread' => $thread,
            ));
        }

        return $this->redirect($redirectUri);
    }

    public function unlikeAction(Request $request, $id)
    {
        $securityContext = $this->get('security.context');

        if (!$securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        /** @var ThreadManagerInterface $threadManager */
        $threadManager = $this->get('dcs_like.manager.thread');

        if (null === $thread = $threadManager->findOneById($id)) {
            throw new NotFoundHttpException();
        }

        /** @var LikeManagerInterface $likeManager */
        $likeManager = $this->get('dcs_like.manager.like');

        if (null !== $like = $likeManager->findOneByThreadAndUser($thread, $securityContext->getToken()->getUser())) {
            $likeManager->remove($like);
        }

        if ($request->isXmlHttpRequest()) {
            return $this->render('DCSLikeBundle:Like:link.html.twig', array(
                'thread' => $thread,
                'isLiked' => false,
            ));
        }

        if (null === $redirectUri = $request->headers->get('referer', $thread->getPermalink())) {
            return $this->render('@DCSLike/Like/unliked.html.twig', array(
                'thread' => $thread,
            ));
        }

        return $this->redirect($redirectUri);
    }
} 