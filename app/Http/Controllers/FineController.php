<?php

namespace App\Http\Controllers;

use App\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
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
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Fine $fine)
    {
        return response()->json($fine->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\Response
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fine  $fine
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Fine $fine)
    {
        $request->validate([
            'description' => 'required',
            'sum' => 'required|integer',
        ], $request->all());

        $fine->fill($request->all());
        $fine->save();

        return response()->json($fine->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Fine $fine
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();

        return response()->json();
    }
}
