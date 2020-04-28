<?php

namespace App\Http\Controllers;

use App\JobDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $jobDescriptions */
        $jobDescriptions = JobDescription::orderBy('created_at', 'desc')->paginate(20);

        return response()->view('job_description.index', compact('jobDescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('job_description.create');
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
            'title' => 'required',
            'content' => 'required',
        ], $request->all());

        /** @var JobDescription $jobDescription */
        $jobDescription = JobDescription::create($request->all());

        return response()->json($jobDescription->toArray(), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function show(JobDescription $jobDescription)
    {
        return response()->view('job_description.show', compact('jobDescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(JobDescription $jobDescription)
    {
        return response()->view('job_description.edit', compact('jobDescription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobDescription  $jobDescription
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, JobDescription $jobDescription)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], $request->all());

        $jobDescription->update($request->all());

        return response()->json($jobDescription->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\JobDescription $jobDescription
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(JobDescription $jobDescription)
    {
        $jobDescription->delete();

        return response()->json();
    }
}
