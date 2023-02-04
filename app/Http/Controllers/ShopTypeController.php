<?php

namespace App\Http\Controllers;

use App\Models\ShopType;
use App\Http\Requests\StoreShopTypeRequest;
use App\Http\Requests\UpdateShopTypeRequest;

class ShopTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreShopTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopType  $shopType
     * @return \Illuminate\Http\Response
     */
    public function show(ShopType $shopType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopType  $shopType
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopType $shopType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopTypeRequest  $request
     * @param  \App\Models\ShopType  $shopType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopTypeRequest $request, ShopType $shopType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopType  $shopType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopType $shopType)
    {
        //
    }
}
