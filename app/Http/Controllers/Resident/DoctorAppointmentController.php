<?php

namespace App\Http\Controllers\Resident;

use App\DoctorAppointment;
use App\Events\NewDoctorAppointment;
use App\Http\Controllers\Controller;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorAppointmentController extends Controller
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
            'doctor' => 'required|max:255',
            'drug' => 'required|max:255',
            'reception_schedule' => 'required|max:1000',
        ]);

        /** @var DoctorAppointment $doctorAppointment */
        $doctorAppointment = DoctorAppointment::create(array_merge($request->toArray(), [
            'resident_id' => $resident->id,
        ]));
        
        event(new NewDoctorAppointment($doctorAppointment));

        return response()->json($doctorAppointment->toArray(), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Resident $resident
     * @param \App\DoctorAppointment $doctorAppointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Resident $resident, DoctorAppointment $doctorAppointment)
    {
        return response()->json($doctorAppointment->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorAppointment  $doctorAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorAppointment $doctorAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Resident $resident
     * @param \App\DoctorAppointment $doctorAppointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Resident $resident, DoctorAppointment $doctorAppointment)
    {
        $request->validate([
            'doctor' => 'required|max:255',
            'drug' => 'required|max:255',
            'reception_schedule' => 'required|max:1000',
        ]);

        $doctorAppointment->update($request->toArray());

        return response()->json($doctorAppointment->refresh()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resident $resident
     * @param \App\DoctorAppointment $doctorAppointment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Resident $resident, DoctorAppointment $doctorAppointment)
    {
        $doctorAppointment->delete();

        return response()->json();
    }
}
