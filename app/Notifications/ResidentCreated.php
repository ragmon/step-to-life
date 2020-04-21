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
            ->content("Создан резидент *{$this->resident->fullname}*")
            ->button('Просмотреть', route('residents.show', [$this->resident->id]));
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
