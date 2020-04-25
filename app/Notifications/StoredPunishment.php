<?php

namespace App\Notifications;

use App\Punishment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class StoredPunishment extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Punishment
     */
    private $punishment;

    /**
     * Create a new notification instance.
     *
     * @param Punishment $punishment
     */
    public function __construct(Punishment $punishment)
    {
        $this->punishment = $punishment;
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
*Выдано взыскание резиденту*

*Выдал:* {$this->punishment->user->fullname}
*Резиденту:* {$this->punishment->resident->fullname}
*Дата начала:* {$this->punishment->start_at->format('d.m.Y')}
*Дата завершения:* {$this->punishment->end_at->format('d.m.Y')}
*Описание:* {$this->punishment->description}
EOF
)
            ->button('Подробнее', $this->punishment->resident->link);
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
