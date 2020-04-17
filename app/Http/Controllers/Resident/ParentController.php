<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Resident;
use App\ResidentParent;
use Illuminate\Http\Request;

class ParentController extends Controller
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
            'firstname' => 'required',
            'lastname' => 'required',
            'patronimyc' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'birthday' => 'required|date',
            'phone' => 'required',
            'about' => 'nullable|max:10000',
        ]);

        /** @var ResidentParent $parent */
        $parent = $resident->parents()->create($request->all());

        return response()->json($parent->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResidentParent  $residentParent
     * @return \Illuminate\Http\Response
     */
    public function show(ResidentParent $residentParent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResidentParent  $residentParent
     * @return \Illuminate\Http\Response
     */
    public function edit(ResidentParent $residentParent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResidentParent  $residentParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResidentParent $residentParent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResidentParent  $residentParent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResidentParent $residentParent)
    {
        //
    }
}
