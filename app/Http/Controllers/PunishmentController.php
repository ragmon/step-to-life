<?php

namespace App\Http\Controllers;

use App\Punishment;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $punishments */
        $punishments = Punishment::orderBy('created_at', 'desc')->paginate(20);

        return response()->view('punishment.index', compact('punishments'));
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
     * @param  \App\Punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function show(Punishment $punishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Punishment $punishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Punishment $punishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Punishment $punishment)
    {
        //
    }
}
