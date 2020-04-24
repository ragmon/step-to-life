<?php

namespace App\Notifications;

use App\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewNote extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Note
     */
    private $note;

    /**
     * Create a new notification instance.
     *
     * @param Note $note
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
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
     * @param \Illuminate\Notifications\AnonymousNotifiable $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->routeNotificationFor(TelegramChannel::class))
            ->content(<<<EOF
*Добавлена новая заметка*

*От сотрудника:* {$this->note->user->fullname}

*Для:* {$this->note->notable->fullname}

*Текст заметки:* {$this->note->content}

*Подробнее:* {$this->note->notable->link}
EOF
            );
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
