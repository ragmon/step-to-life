<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $reports */
        $reports = Report::orderBy('created_at', 'desc')->paginate(15);

        return response()->view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('report.create');
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

        /** @var Report $report */
        $report = Report::create(array_merge($request->all(), [
            'user_id' => Auth::id(),
        ]));

        return response()->json($report->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return response()->view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return response()->view('report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], $request->all());

        $report->update($request->all());

        return response()->json($report->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Report $report
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return response()->json();
    }
}
