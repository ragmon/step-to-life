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
            ->content("Выдано взыскание резеденту *{$this->punishment->resident->fullname}*")
            ->button('Просмотреть', route('resident.show', [$this->punishment->resident->id]));
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
