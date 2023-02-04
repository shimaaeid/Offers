<?php

namespace App\Http\Controllers;

use App\Models\UserLikes;
use App\Http\Requests\StoreUserLikesRequest;
use App\Http\Requests\UpdateUserLikesRequest;

class UserLikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $likes = UserLikes::all();

        return view('admin.userLikes.index', compact('likes'));
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
     * @param  \App\Http\Requests\StoreUserLikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserLikesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLikes  $userLikes
     * @return \Illuminate\Http\Response
     */
    public function show(UserLikes $userLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLikes  $userLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLikes $userLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserLikesRequest  $request
     * @param  \App\Models\UserLikes  $userLikes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserLikesRequest $request, UserLikes $userLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLikes  $userLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLikes $userLikes)
    {
        //
    }
}
