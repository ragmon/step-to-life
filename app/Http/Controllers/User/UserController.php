<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Resident;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var LengthAwarePaginator $users */
        $users = User::orderBy('created_at', 'desc')->paginate(15);

        return response()->view('user.index', compact('users'));
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
            'email' => 'required|email',
            'phone' => 'required|max:32',
            'firstname' => 'required|max:32',
            'lastname' => 'required|max:32',
            'patronymic' => 'required|max:32',
            'role' => 'required|max:32',
        ]);

        /** @var User $user */
        $user = User::create(array_merge($request->all(),
        [
            'password' => bcrypt('secret'),
        ]));

        return response()->json($user->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (request()->expectsJson()) {
            return response()->json($user->toArray());
        } else {
            /** @var Collection $residents */
            $residents = Resident::all();
            /** @var Collection $users */
            $users = User::all();

            return response()->view('user.show', compact('user', 'users', 'residents'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|max:32',
            'firstname' => 'required|max:32',
            'lastname' => 'required|max:32',
            'patronymic' => 'required|max:32',
            'role' => 'required|max:32',
        ], $request->all());

        $user->update($request->all());

        return response()->json($user->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json();
    }
}
