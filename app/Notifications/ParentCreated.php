<?php

namespace App\Notifications;

use App\ResidentParent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class ParentCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var ResidentParent
     */
    private $parent;

    /**
     * Create a new notification instance.
     *
     * @param ResidentParent $parent
     */
    public function __construct(ResidentParent $parent)
    {
        $this->parent = $parent;
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
*Добавлен новый родственик*

*Для резидента:* {$this->parent->resident->fullname}
*Кем приходится:* {$this->parent->role}
*ФИО:* {$this->parent->fullname}
*Пол:* {$this->parent->gender_title}
*Дата рождения:* {$this->parent->birthday}
*Телефон:* {$this->parent->phone}
*Дополнительная информация:* {$this->parent->about}
EOF
                )
            ->button('Подробнее', $this->parent->link);
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
