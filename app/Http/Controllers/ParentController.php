<?php

namespace App\Http\Controllers;

use App\ResidentParent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $parents */
        $parents = ResidentParent::paginate(20);

        return response()->view('resident_parent.index', compact('parents'));
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
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var ResidentParent $parent */
        $parent = ResidentParent::find($id);

        if (request()->expectsJson()) {
            return response()->json($parent->toArray());
        } else {
            return response()->view('resident_parent.show', compact('parent'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
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
        $parent = ResidentParent::find($id);

        $parent->update($request->all());

        return response()->json($parent->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentParent $parent
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ResidentParent $parent)
    {
        $parent->delete();

        return response()->json();
    }
}
