<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Punishment;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PunishmentController extends Controller
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
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        /** @var Punishment $punishment */
        $punishment = $resident->punishments()->create(array_merge($request->all(),
            [
                'user_id' => Auth::id(),
            ]
        ));

        return response()->json($punishment->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param Punishment $punishment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Punishment $punishment)
    {
        return response()->json($punishment->toArray());
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param Punishment $punishment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, Punishment $punishment)
    {
        $request->validate([
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        $punishment->update($request->all());

        return response()->json($punishment->refresh()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Punishment $punishment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id, Punishment $punishment)
    {
        $punishment->delete();

        return response()->json();
    }
}
