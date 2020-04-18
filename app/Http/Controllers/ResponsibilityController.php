<?php

namespace App\Http\Controllers;

use App\Responsibility;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ResponsibilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $responsibilities */
        $responsibilities = Responsibility::paginate(20);

        return response()->view('responsibility.index', compact('responsibilities'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'about' => 'nullable',
        ]);

        /** @var Responsibility $responsibility */
        $responsibility = Responsibility::create($request->all());

        return response()->json($responsibility->toArray(), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Responsibility  $responsibility
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Responsibility $responsibility)
    {
        return response()->json($responsibility->toArray());
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Responsibility $responsibility)
    {
        $request->validate([
            'name' => 'required|max:255',
            'about' => 'nullable',
        ]);

        $responsibility->update($request->all());

        return response()->json($responsibility->refresh()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Responsibility $responsibility
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Responsibility $responsibility)
    {
        $responsibility->delete();

        return response()->json();
    }
}
