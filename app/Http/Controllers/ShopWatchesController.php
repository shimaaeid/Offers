<?php

namespace App\Http\Controllers;

use App\Models\ShopWatches;
use App\Http\Requests\StoreShopWatchesRequest;
use App\Http\Requests\UpdateShopWatchesRequest;

class ShopWatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $watches = ShopWatches::all();

        return view('admin.shop_watches.index', compact('watches'));
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
     * @param  \App\Http\Requests\StoreShopWatchesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopWatchesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopWatches  $shopWatches
     * @return \Illuminate\Http\Response
     */
    public function show(ShopWatches $shopWatches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopWatches  $shopWatches
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopWatches $shopWatches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopWatchesRequest  $request
     * @param  \App\Models\ShopWatches  $shopWatches
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopWatchesRequest $request, ShopWatches $shopWatches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopWatches  $shopWatches
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopWatches $shopWatches)
    {
        //
    }
}
