<?php

namespace App\Listeners;

use App\Event;
use App\Events\NewDoctorAppointment;
use App\Events\NewNote;
use App\Events\NewTask;
use App\Events\ParentCreated;
use App\Events\ResidentCreated;
use App\Events\StoredPunishment;
use App\Events\UserFined;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use App\Notifications\NewDoctorAppointment as NewDoctorAppointmentNotification;
use App\Notifications\NewNote as NewNoteNotification;
use App\Notifications\NewTask as NewTaskNotification;
use App\Notifications\ResidentCreated as ResidentCreatedNotification;
use App\Notifications\StoredPunishment as StoredPunishmentNotification;
use App\Notifications\UserFined as UserFinedNotification;
use App\Notifications\ParentCreated as ParentCreatedNotification;

/**
 * Class HistorySubscriber
 *
 * @package App\Listeners
 */
class HistorySubscriber
{
    /**
     * Handle new doctor appointment events.
     *
     * @param NewDoctorAppointment $event
     */
    public function handleNewDoctorAppointment(NewDoctorAppointment $event)
    {
        $this->createEvent(
            sprintf(
                'Создано назначение врача для <a href="%s">%s</a>',
                $event->doctorAppointment->resident->link,
                $event->doctorAppointment->resident->fullname
            )
        );

        $this->sendNotify(new NewDoctorAppointmentNotification($event->doctorAppointment));
    }

    /**
     * Handle new note events.
     *
     * @param NewNote $event
     */
    public function handleNewNote(NewNote $event)
    {
        $this->createEvent(
            sprintf('Добавлена заметка для <a href="%s">%s</a>', $event->note->notable->link, $event->note->notable->fullname)
        );

        $this->sendNotify(new NewNoteNotification($event->note));
    }

    /**
     * Handle new task events.
     *
     * @param NewTask $event
     */
    public function handleNewTask(NewTask $event)
    {
        $this->createEvent(
            sprintf('Создано задание <a href="%s">%s</a>', $event->task->link, $event->task->title)
        );

        $this->sendNotify(new NewTaskNotification($event->task));
    }

    /**
     * Handle resident created events.
     *
     * @param ResidentCreated $event
     */
    public function handleResidentCreated(ResidentCreated $event)
    {
        $this->createEvent(
            sprintf('Создан резидент <a href="%s">%s</a>', $event->resident->link, $event->resident->fullname)
        );

        $this->sendNotify(new ResidentCreatedNotification($event->resident));
    }

    /**
     * Handle stored punishment events.
     *
     * @param StoredPunishment $event
     */
    public function handleStoredPunishment(StoredPunishment $event)
    {
        $this->createEvent(
            sprintf(
                'Выдано взыскание для <a href="%s">%s</a>',
                $event->punishment->resident->link,
                $event->punishment->resident->fullname
            )
        );

        $this->sendNotify(new StoredPunishmentNotification($event->punishment));
    }

    /**
     * Handle stored punishment events.
     *
     * @param UserFined $event
     */
    public function handleUserFined(UserFined $event)
    {
        $this->createEvent(
            sprintf(
                'Выдан штраф для <a href="%s">%s</a>',
                $event->fine->user->link,
                $event->fine->user->fullname
            )
        );

        $this->sendNotify(new UserFinedNotification($event->fine));
    }

    /**
     * Handle stored punishment events.
     *
     * @param ParentCreated $event
     */
    public function handleParentCreated(ParentCreated $event)
    {
        $this->createEvent(
            sprintf(
                'Создан родственик <a href="%s">%s</a> для резидента <a href="%s">%s</a>',
                $event->parent->link,
                $event->parent->fullname,
                $event->parent->resident->link,
                $event->parent->resident->fullname
            )
        );

        $this->sendNotify(new ParentCreatedNotification($event->parent));
    }

    /**
     * Get current authenticated user instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null|User
     */
    private function user()
    {
        return Auth::user();
    }

    /**
     * Send notification.
     *
     * @param $notification
     */
    protected function sendNotify($notification)
    {
        if ($telegramChatId = config('notifications.telegram.chat_id')) {
            Notification::route(TelegramChannel::class, $telegramChatId)
                ->notify($notification);
        }
    }

    /**
     * Create history event entry.
     *
     * @param $description
     * @param $icon
     * @return Event|\Illuminate\Database\Eloquent\Model
     */
    protected function createEvent($description, $icon = 'history')
    {
        return $this->user()->events()->create([
            'title' => sprintf('<a href="%s">%s</a>', $this->user()->link, $this->user()->fullname),
            'description' => $description,
            'icon' => $icon,
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\NewDoctorAppointment',
            'App\Listeners\HistorySubscriber@handleNewDoctorAppointment'
        );

        $events->listen(
            'App\Events\NewNote',
            'App\Listeners\HistorySubscriber@handleNewNote'
        );

        $events->listen(
            'App\Events\NewTask',
            'App\Listeners\HistorySubscriber@handleNewTask'
        );

        $events->listen(
            'App\Events\ResidentCreated',
            'App\Listeners\HistorySubscriber@handleResidentCreated'
        );

        $events->listen(
            'App\Events\StoredPunishment',
            'App\Listeners\HistorySubscriber@handleStoredPunishment'
        );

        $events->listen(
            'App\Events\UserFined',
            'App\Listeners\HistorySubscriber@handleUserFined'
        );

        $events->listen(
            'App\Events\ParentCreated',
            'App\Listeners\HistorySubscriber@handleParentCreated'
        );
    }
}
