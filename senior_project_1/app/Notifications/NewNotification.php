<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewNotification extends Notification
{
    protected $notification;

    // Inject the notification data
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    // Determine the delivery channels (email in this case)
    public function via($notifiable)
    {
        return ['mail']; // This means the notification will be sent by email
    }

    // Set up the email content
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Notification')
            ->line('You have a new notification.')
            ->line('Notification Type: ' . $this->notification->notification_type)
            ->line('Message: ' . $this->notification->message)
            ->line('Sent At: ' . $this->notification->sent_at->format('Y-m-d H:i'));
    }
}
