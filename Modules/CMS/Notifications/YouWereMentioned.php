<?php

namespace Modules\CMS\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class YouWereMentioned extends Notification
{
    use Queueable;

    /**
     * The new reply.
     *
     * @var \Modules\CMS\Entities\Reply
     */
    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @param \Modules\CMS\Entities\Reply $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->reply->authorRelation->full_name . ' mentioned you in ' . $this->reply->article->title,
            'link' => $this->reply->path()
        ];
    }
}
