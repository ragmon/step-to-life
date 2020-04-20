<?php

namespace App\Listeners;

use App\Events\NewDoctorAppointment;
use App\Events\NewNote;
use App\Events\NewTask;
use App\Events\ResidentCreated;
use App\Events\StoredPunishment;
use App\Events\UserFined;

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
        //
    }

    /**
     * Handle new note events.
     *
     * @param NewNote $event
     */
    public function handleNewNote(NewNote $event)
    {
        //
    }

    /**
     * Handle new task events.
     *
     * @param NewTask $event
     */
    public function handleNewTask(NewTask $event)
    {
        //
    }

    /**
     * Handle resident created events.
     *
     * @param ResidentCreated $event
     */
    public function handleResidentCreated(ResidentCreated $event)
    {
        //
    }

    /**
     * Handle stored punishment events.
     *
     * @param StoredPunishment $event
     */
    public function handleStoredPunishment(StoredPunishment $event)
    {
        //
    }

    /**
     * Handle stored punishment events.
     *
     * @param UserFined $event
     */
    public function handleUserFined(UserFined $event)
    {
        //
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
    }
}
