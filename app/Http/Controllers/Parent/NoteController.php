<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Note;
use App\ResidentParent;
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
     * @param ResidentParent $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, ResidentParent $parent)
    {
        $request->validate([
            'content' => 'required|max:10000'
        ]);

        $note = $parent->notes()->create(array_merge($request->all(), [
            'user_id' => Auth::id(),
        ]));

        return response()->json($note->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Note $note
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id, Note $note)
    {
        $note->delete();

        return response()->json();
    }
}
