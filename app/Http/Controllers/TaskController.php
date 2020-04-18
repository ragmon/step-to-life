<?php

namespace App\Http\Controllers;

use App\Resident;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $tasks */
        $tasks = Task::orderBy('created_at', 'desc')->paginate(20);
        /** @var Collection $residents */
        $residents = Resident::all();
        /** @var Collection $users */
        $users = User::all();

        return response()->view('task.index', compact('tasks', 'users', 'residents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'finished_at' => 'nullable|date',
            // relations
            'resident' => 'array',
            'user' => 'array',
        ], $request->all());

        /** @var Task $task */
        $task = Task::create(array_merge($request->all(), [
            'user_id' => Auth::id(),
        ]));

        $task->users()->sync(
            $this->prepareSyncData(
                $request->input('user', []),
                'finished_at',
                $request->input('finished_at')
            )
        );
        $task->residents()->sync(
            $this->prepareSyncData(
                $request->input('resident', []),
                'finished_at',
                $request->input('finished_at')
            )
        );

        return response()->json($task->toArray());
    }

    /**
     * Prepare sync data.
     *
     * @param $ids
     * @param $pivotField
     * @param $pivotValue
     * @return array
     */
    protected function prepareSyncData($ids, $pivotField, $pivotValue)
    {
        $result = [];
        foreach ($ids as $id) {
            $result[$id] = [$pivotField => $pivotValue];
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if (request()->expectsJson()) {
            $task->load('users', 'residents');

            return response()->json($task->toArray());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            // relations
            'resident' => 'array',
            'user' => 'array',
        ], $request->all());

        $task->update($request->all());

        $task->users()->sync($request->input('user', []));
        $task->residents()->sync($request->input('resident', []));

        return response()->json($task->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json();
    }
}
