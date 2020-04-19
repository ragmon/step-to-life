<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Resident;
use App\Responsibility;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $residents */
        $residents = Resident::orderBy('registered_at', 'desc')->paginate(20);

        return response()->view('resident.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('resident.create');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'patronymic' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'birthday' => 'required|date',
            'registered_at' => 'required|date',
            'about' => 'nullable',
            'source' => 'required',
            'balance' => 'required',
            'status' => 'boolean',
        ]);

        /** @var Resident $resident */
        $resident = Resident::create($request->all());

        return response()->json($resident->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        /** @var Collection $responsibilities */
        $responsibilities = Responsibility::all();
        /** @var Collection $residents */
        $residents = Resident::all();
        /** @var Collection $users */
        $users = User::all();

        return response()->view('resident.show', compact('resident', 'responsibilities', 'residents', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Resident $resident
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();

        return response()->json();
    }
}
