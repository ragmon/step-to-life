<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Resident;
use App\Responsibility;
use Illuminate\Http\Request;

class ResponsibilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Resident $resident
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Resident $resident)
    {
        return response()->json($resident->responsibilities->toArray());
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
    public function store(Request $request, Resident $resident)
    {
        $request->validate([
            'responsibility' => 'array',
            'responsibility.*' => 'integer'
        ]);

        $resident->responsibilities()->sync($request->input('responsibility', []));

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function show(Responsibility $responsibility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function edit(Responsibility $responsibility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Responsibility $responsibility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Responsibility  $responsibility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsibility $responsibility)
    {
        //
    }
}
