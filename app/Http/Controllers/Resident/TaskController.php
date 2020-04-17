<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param Resident $resident
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Resident $resident, $id)
    {
        $resident->tasks()->updateExistingPivot($id, ['finished_at' => Carbon::now()]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resident $resident
     * @param $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Resident $resident, $taskId)
    {
        $resident->tasks()->detach($taskId);

        return response()->json();
    }
}
