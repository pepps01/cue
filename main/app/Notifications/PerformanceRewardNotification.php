<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PerformanceRewardNotification extends Notification
{
    use Queueable;

    public $name;
    public $count;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $count)
    {
        //
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Performance Reward Notification')
            ->greeting('Hello ' . $this->name)
            ->line('Congratulations, on completing a total of ' . $this->count . ' Rides')
            ->line('In appreciation of your performance, you have been awarded with a Bonus of NGN' . number_format(env('DRIVER_PERFORMANCE_REWARD'), 2) . ' to your Wallet');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
