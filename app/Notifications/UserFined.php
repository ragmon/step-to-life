<?php

namespace App\Notifications;

use App\Fine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class UserFined extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Fine
     */
    private $fine;

    /**
     * Create a new notification instance.
     *
     * @param Fine $fine
     */
    public function __construct(Fine $fine)
    {
        $this->fine = $fine;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the Telegram representation of notification.
     *
     * @param $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content("Выдан штраф для *{$this->fine->user->fullname}*")
            ->button('Просмотреть', route('users.show', [$this->fine->user->id]));
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
