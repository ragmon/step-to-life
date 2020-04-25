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
            ->to($notifiable->routeNotificationFor(TelegramChannel::class))
            ->content(<<<EOF
*Сотрудник оштрафован*

*Сотрудник:* {$this->fine->user->fullname}
*Описание:* {$this->fine->description}
*Сумма:* {$this->fine->sum}
EOF
)
            ->button('Подробнее', $this->fine->user->link);
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
