<?php

namespace App\Notifications;

use App\DoctorAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewDoctorAppointment extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var DoctorAppointment
     */
    private $doctorAppointment;

    /**
     * Create a new notification instance.
     *
     * @param DoctorAppointment $doctorAppointment
     */
    public function __construct(DoctorAppointment $doctorAppointment)
    {
        $this->doctorAppointment = $doctorAppointment;
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
*Добавлено назначение врача*

*Кому:* {$this->doctorAppointment->resident->fullname}

*Врач:* {$this->doctorAppointment->doctor}
*Препарат:* {$this->doctorAppointment->drug}
*Схема приёма:* {$this->doctorAppointment->reception_schedule}
EOF
            )
            ->button('Подробнее', $this->doctorAppointment->resident->link);
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
