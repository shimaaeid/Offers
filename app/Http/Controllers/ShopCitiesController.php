<?php

namespace App\Http\Controllers;

use App\Models\ShopCities;
use App\Http\Requests\StoreShopCitiesRequest;
use App\Http\Requests\UpdateShopCitiesRequest;

class ShopCitiesController extends Controller
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
     * @param  \App\Http\Requests\StoreShopCitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopCitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopCities  $shopCities
     * @return \Illuminate\Http\Response
     */
    public function show(ShopCities $shopCities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopCities  $shopCities
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopCities $shopCities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopCitiesRequest  $request
     * @param  \App\Models\ShopCities  $shopCities
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopCitiesRequest $request, ShopCities $shopCities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopCities  $shopCities
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopCities $shopCities)
    {
        //
    }
}
