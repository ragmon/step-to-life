<?php

namespace App\Notifications;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewTask extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Task
     */
    private $task;

    /**
     * Create a new notification instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
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
        $toResidents = $this->implodeRecipients($this->task->residents, '*Резидентам:* ', 'fullname');
        $toUsers = $this->implodeRecipients($this->task->users, '*Сотрудникам:* ', 'fullname');

        return TelegramMessage::create()
            ->to($notifiable->routeNotificationFor(TelegramChannel::class))
            ->content(<<<EOF
*Добавлено задание*

{$toResidents}{$toUsers}
*Дата начала:* {$this->task->start_at->format('d.m.Y')}
*Дата окончания:* {$this->task->end_at->format('d.m.Y')}

*{$this->task->title}*

{$this->task->description}
EOF
                )
            ->button('Подробнее', $this->task->link);
    }

    /**
     * Implode recipients with prefix.
     *
     * @param Collection $collection
     * @param string $prefix
     * @param string $key
     * @param string $glue
     * @return string
     */
    private function implodeRecipients($collection, $prefix, $key, $glue = ', ')
    {
        if ($collection && $collection->count() > 0) {
            return $prefix . $collection->implode($key, $glue) . "\n";
        } else
            return '';
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
