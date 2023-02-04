<?php

namespace App\Http\Controllers\Api;

use App\Events\visitStoreDetailsApi;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Models\ShopType;

class ShopController extends Controller
{
    //

    public function onlineStores($id = null)
    {
        // return "123";

        $data = Shop::whereHas('cities', function ($query) use ($id) {
            $query->where('cities.id', $id);
        })
            ->whereHas('shopType', function ($query) {
                $query->where('shoptype_id', '=', 2);
            })
            ->get();

        if ($id == null) {
            $data = Shop::whereHas('shopType', function ($query) {
                $query->where('shoptype_id', '=', 2);
            })->get();
            return ShopResource::collection($data);
        }

        return ShopResource::collection($data);
    }

    public function storeDetails($id)
    {
        $shop = Shop::find($id);

        event(new visitStoreDetailsApi($shop));

         return new ShopResource($shop);
    }

    public function categoryStores(Request $request)
    {
        $category_id = $request->category_id;
        $city_id = $request->city_id;

        $data = Shop::whereHas('cities', function ($query) use ($city_id) {
            $query->where('cities.id', $city_id);
        })
            ->whereHas('category', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->get();

        if (empty($city_id)) {
            $data = Shop::whereHas('category', function ($query) use (
                $category_id
            ) {
                $query->where('category_id', $category_id);
            })->get();

            return ShopResource::collection($data);
        }

        return ShopResource::collection($data);
    }
}
