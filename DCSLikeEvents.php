<?php

namespace DCS\LikeBundle;

class DCSLikeEvents
{
    /**
     * The PRE_PERSIST event occurs prior to the persistence backend persisting the Thread.
     *
     * This event allows you to modify the data in the Thread prior to persisting occuring.
     * The listener receives a:
     * DCS\LikeBundle\Event\ThreadEvent instance.
     *
     * @see \DCS\LikeBundle\Event\ThreadEvent
     * @var string
     */
    const THREAD_PRE_PERSIST = 'dcs_like.event.thread.pre_persist';

    /**
     * The POST_PERSIST event occurs after to the persistence backend persisted the Thread.
     *
     * This event allows you to notify users or perform other actions that might require the
     * Thread to be persisted before performing those actions.
     * The listener receives a
     * DCS\LikeBundle\Event\ThreadEvent instance.
     *
     * @see \DCS\LikeBundle\Event\ThreadEvent
     * @var string
     */
    const THREAD_POST_PERSIST = 'dcs_like.event.thread.post_persist';

    /**
     * The PRE_PERSIST event occurs prior to the persistence backend persisting the Like.
     *
     * This event allows you to modify the data in the Like prior to persisting occuring.
     * The listener receives a:
     * DCS\LikeBundle\Event\LikeEvent instance.
     *
     * @see \DCS\LikeBundle\Event\LikeEvent
     * @var string
     */
    const LIKE_PRE_PERSIST = 'dcs_like.event.like.pre_persist';

    /**
     * The POST_PERSIST event occurs after to the persistence backend persisted the Like.
     *
     * This event allows you to notify users or perform other actions that might require the
     * Like to be persisted before performing those actions.
     * The listener receives a
     * DCS\LikeBundle\Event\LikeEvent instance.
     *
     * @see \DCS\LikeBundle\Event\LikeEvent
     * @var string
     */
    const LIKE_POST_PERSIST = 'dcs_like.event.like.post_persist';

    /**
     * The PRE_PERSIST event occurs prior to the persistence backend persisting the Like.
     *
     * This event allows you to modify the data in the Like prior to persisting occuring.
     * The listener receives a:
     * DCS\LikeBundle\Event\LikeEvent instance.
     *
     * @see \DCS\LikeBundle\Event\LikeEvent
     * @var string
     */
    const LIKE_PRE_REMOVE = 'dcs_like.event.like.pre_remove';

    /**
     * The POST_PERSIST event occurs after to the persistence backend persisted the Like.
     *
     * This event allows you to notify users or perform other actions that might require the
     * Like to be persisted before performing those actions.
     * The listener receives a
     * DCS\LikeBundle\Event\LikeEvent instance.
     *
     * @see \DCS\LikeBundle\Event\LikeEvent
     * @var string
     */
    const LIKE_POST_REMOVE = 'dcs_like.event.like.post_remove';
}