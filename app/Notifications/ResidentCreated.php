<?php

namespace App\Notifications;

use App\Resident;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class ResidentCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Resident
     */
    private $resident;

    /**
     * Create a new notification instance.
     *
     * @param Resident $resident
     */
    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
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
*Создан резидент*

*ФИО:* {$this->resident->fullname}
*Пол:* {$this->resident->gender_title}
*Дата рождения:* {$this->resident->birthday->format('d.m.Y')}
*Дата регистрации:* {$this->resident->registered_at->format('d.m.Y')}
*Источник поступления:* {$this->resident->source}
*Статус:* {$this->resident->status}
*Баланс:* {$this->resident->balance}
*Дополнительная информация:* {$this->resident->about}
EOF
            )
            ->button('Подробнее', $this->resident->link);
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
