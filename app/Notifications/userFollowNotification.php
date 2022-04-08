<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class userFollowNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toSlack($notifiable){
       return (new SlackMessage)->content($this->user['name']." started Following You!!!");
    }
   
    public function toArray($notifiable)
    {
        return [
            "user_id"=>$this->user['id'],
            "name"=>$this->user['name'],
            "email"=>$this->user['email'],
        ];
    }
}
