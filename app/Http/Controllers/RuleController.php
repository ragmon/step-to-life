<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $reports */
        $rules = Rule::orderBy('created_at', 'desc')->paginate(15);

        return response()->view('rule.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('rule.create');
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

        /** @var Rule $report */
        $report = Rule::create(array_merge($request->all(), [
            'user_id' => Auth::id(),
        ]));

        return response()->json($report->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        return response()->view('rule.show', compact('rule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {
        return response()->view('rule.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], $request->all());

        $rule->update($request->all());

        return response()->json($rule->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Rule $rule
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();

        return response()->json();
    }
}
