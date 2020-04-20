<?php

namespace App\Http\Controllers\Resident;

use App\Events\NewNote;
use App\Http\Controllers\Controller;
use App\Note;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @param Resident $resident
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Resident $resident)
    {
        $request->validate([
            'content' => 'required|max:10000'
        ]);

        /** @var Note $note */
        $note = $resident->notes()->create(array_merge($request->all(), [
            'user_id' => Auth::id(),
        ]));

        event(new NewNote($note));

        return response()->json($note->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param \App\Note $note
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id, Note $note)
    {
        $note->delete();

        return response()->json();
    }
}
