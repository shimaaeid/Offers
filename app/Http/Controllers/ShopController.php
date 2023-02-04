<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\PackageType;
use App\Models\ShopCities;
use App\Models\ShopType;
use Illuminate\Http\Request;
Use \Carbon\Carbon;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shops = Shop::all();
        $shopType = ShopType::all();
        $categories = Category::all();
        $packageType = PackageType::all();
        $countries = Country::all();
        return view(
            'admin.shops.index',
            compact(
                'shops',
                'shopType',
                'categories',
                'packageType',
                'countries'
            )
        );
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
     * @param  \App\Http\Requests\StoreShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        // return $request->all();
        if (
            Shop::where('name->ar', $request->name)
                ->orWhere('name->en', $request->name_en)
                ->exists()
        ) {
            return redirect()
                ->back()
                ->withErrors(trans('shops.exists'));
        }
        try {
            $validated = $request->validated();
            $shop = new Shop();

            $shop_profile_url = '';

            if ($request->file('profile_path')) {
                $shopProfile = $request->file('profile_path');
                $shopProfileSaveAsName =
                    time() . $shopProfile->getClientOriginalExtension();

                $upload_path = 'Attachments/ShopProfile/';
                $shop_profile_url = $upload_path . $shopProfileSaveAsName;
                $success = $shopProfile->move(
                    $upload_path,
                    $shopProfileSaveAsName
                );
            }

            // ------------------------------------------

            $shop_cover_url = '';

            if ($request->file('cover_path')) {
                $shopCover = $request->file('cover_path');
                $shopCoverSaveAsName =
                    time() . $shopCover->getClientOriginalExtension();

                $upload_path = 'Attachments/shopCover/';
                $shop_cover_url = $upload_path . $shopCoverSaveAsName;
                $success = $shopCover->move($upload_path, $shopCoverSaveAsName);
            }

            $mac = \exec('getmac');
            $mac2 = strtok($mac, ' ');

            $name = ['en' => $request->name_en, 'ar' => $request->name];
            $shop->setTranslations('name', $name);
            $shop->email = $request->email;
            $shop->password = $request->password;
            $shop->phone = $request->phone;
            $shop->mac_add = $mac2;

            $opening = [
                'en' => $request->opening_hours_en,
                'ar' => $request->opening_hours,
            ];
            $shop->setTranslations('opening_hours', $opening);

            $location = [
                'en' => $request->location_en,
                'ar' => $request->location,
            ];
            $shop->setTranslations('location', $location);

            $shop->location_url = $request->location_url;
            $shop->whatsapp = $request->whatsapp;
            $shop->insta = $request->insta;
            $shop->snap = $request->snap;
            $shop->web_site = $request->web_site;
            $shop->shoptype_id = $request->shoptype_id;
            $shop->months = $request->months;
            $shop->subscription_date =  Carbon::now();
            $shop->expire_date =Carbon::now()->addMonths($shop->months);
            $shop->category_id = $request->category_id;
            $description = [
                'en' => $request->description_en,
                'ar' => $request->description,
            ];
            $shop->setTranslations('description', $description);
            $shop->packagetype_id = $request->packagetype_id;
            $shop->profile_path = $shop_profile_url;
            $shop->cover_path = $shop_cover_url;
            $shop->save();

            // dd($request->city_id);

            for ($i = 0; $i < count($request->city_id); $i++) {
                ShopCities::create([
                    'shop_id' => $shop->id,
                    'city_id' => $request->input('city_id')[$i],
                ]);
            }

            toastr()->success(trans('shops.add_success'));
            return redirect()->route('shops.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shops = Shop::find($id);
        // return $shopCities = ShopCities::where('shop_id', $id)->get();
        $shopType = ShopType::all();
        $categories = Category::all();
        $packageType = PackageType::all();
        $countries = Country::all();
        return view(
            'admin.shops.edit',
            compact(
                'shops',
                'shopType',
                'categories',
                'packageType',
                'countries'
            )
        );
        // dd($shopCities->city->country->name);
        //   $city = ShopCities::where('shop_id', $id)
        //     ->select('city_id')
        //     ->get();

        // // $cities = [];
        // // foreach ($city as $cit) {
        // //     foreach ($cit as $key => $value) {
        // //         $cities[$key] = [
        // //             'city_id' => $value->city_id,
        // //         ];
        // //     }
        // // }

        // // return $city->city_id;

        //  $count = Country::where('id', $city)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request)
    {
        //
        // return $request->all();
        try {
            $validated = $request->validated();
            $shop = Shop::findOrFail($request->id);

            $shop->update([
                ($shop->name = [
                    'en' => $request->name_en,
                    'ar' => $request->name,
                ]),

                ($shop->email = $request->email),
                ($shop->password = $request->password),
                ($shop->phone = $request->phone),
                // $shop->mac_add = $mac2;

                ($opening = [
                    'en' => $request->opening_hours_en,
                    'ar' => $request->opening_hours,
                ]),

                ($location = [
                    'en' => $request->location_en,
                    'ar' => $request->location,
                ]),

                ($shop->location_url = $request->location_url),
                ($shop->whatsapp = $request->whatsapp),
                ($shop->insta = $request->insta),
                ($shop->snap = $request->snap),

                ($shop->web_site = $request->web_site),
                ($shop->shoptype_id = $request->shoptype_id),
                ($shop->months = $request->months),
                ($shop->category_id = $request->category_id),
                ($description = [
                    'en' => $request->description_en,
                    'ar' => $request->description,
                ]),

                ($shop->packagetype_id = $request->packagetype_id),
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('shops.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $shop = Shop::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('shops.index');
    }

    public function updateProfileImage(Request $request)
    {
        $shop = Shop::find($request->id);

        $shopImage = $request->file('profile_path');
        $shopImageSaveAsName =
            time() . $shopImage->getClientOriginalExtension();

        $upload_path = 'Attachments/ShopProfile/';
        $shop_image_url = $upload_path . $shopImageSaveAsName;
        $success = $shopImage->move($upload_path, $shopImageSaveAsName);

        $shop->update([
            'profile_path' => $shop_image_url,
        ]);

        toastr()->success(trans('shops.edit_success'));
        return redirect()->route('shops.index');
    }

    public function updateCoverImage(Request $request)
    {
        $shop = Shop::find($request->id);

        $shopImage = $request->file('cover_path');
        $shopImageSaveAsName =
            time() . $shopImage->getClientOriginalExtension();

        $upload_path = 'Attachments/ShopCover/';
        $shop_image_url = $upload_path . $shopImageSaveAsName;
        $success = $shopImage->move($upload_path, $shopImageSaveAsName);

        $shop->update([
            'cover_path' => $shop_image_url,
        ]);

        toastr()->success(trans('shops.edit_success'));
        return redirect()->route('shops.index');
    }

    public function updateCities(Request $request)
    {
        try {
            // $validated = $request->validated();
            $shop = ShopCities::where('shop_id', $request->id)->findOrFail(
                $request->id
            );

            for ($i = 0; $i < count($request->city_id); $i++) {
                ShopCities::where('shop_id', $request->id)->update([
                    'shop_id' => $shop->id,
                    'city_id' => $request->input('city_id')[$i],
                ]);
            }

            toastr()->success(trans('messages.Update'));
            return redirect()->route('shops.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request){

        $shop = Shop::where('id', $request->id)->update([
            'active' => $request->active
        ]);

        toastr()->success(trans('shops.edit_success'));
        return redirect()->route('shops.index');

    }
}
