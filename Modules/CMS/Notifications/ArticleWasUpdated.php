<?php

namespace Modules\CMS\Notifications;

use Illuminate\Notifications\Notification;

class ArticleWasUpdated extends Notification
{
    /**
     * The thread that was updated.
     *
     * @var \Modules\CMS\Entities\Article
     */
    protected $article;

    /**
     * The new reply.
     *
     * @var \Modules\CMS\Entities\Reply
     */
    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @param \App\Article $article
     * @param \App\Reply  $reply
     */
    public function __construct($article, $reply)
    {
        $this->article = $article;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'message' => $this->reply->authorRelation->full_name . ' replied to ' . $this->article->title,
            'link' => $this->reply->path()
        ];
    }
}

