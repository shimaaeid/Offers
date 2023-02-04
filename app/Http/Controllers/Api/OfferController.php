<?php

namespace App\Http\Controllers\Api;

use App\Events\likeOfferApi;
use App\Models\Shop;
use App\Models\Offers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OnlineOffersResource;
use App\Http\Resources\WishlistResource;
use App\Models\User;
use App\Models\UserLikes;

class OfferController extends Controller
{
    //

    public function topLikedOffers($id = null)
    {
        $data = Shop::whereHas('cities', function ($query) use ($id) {
            $query->where('cities.id', $id);
        })
            ->with([
                'offers' => function ($query) {
                    $query
                        ->orderBy('likes', 'desc')
                        ->limit(25)
                        ->get();
                },
            ])
            ->get();

        $offers = [];
        foreach ($data as $off) {
            foreach ($off->offers as $key => $value) {
                $offers[$key] = [
                    'id' => $value->id,
                    'image_path' => $value->image_path,
                    'title' => $value->title,
                    'shop_id' => $value->shop_id,
                    'shop_image' => $value->shop->profile_path,
                    'shop_name' => $value->shop->name,
                    'category_id' => $value->shop->category->id,
                    'category_name' => $value->shop->category->name,
                    'category_image' => $value->shop->category->image_path,
                ];
            }
        }

        if (empty($id)) {
            $data = Offers::orderBy('likes', 'desc')
                ->limit(25)
                ->get();
            return [
                'Offers' => OfferResource::collection($data)
            ];
        }

        return [
            'Offers' => $offers,
        ];
    }

    public function onlineOffers(Request $request, $id)
    {

        $per_page = $request->per_page;

         $data = Shop::whereHas('cities', function($query) use ($id){
            $query->where('cities.id', $id);
        })->whereHas('shopType', function($query) {
            $query->where('shoptype_id', '=',  2);
        })->with('offers')->paginate($per_page);

        $onlineOffers = [];
        foreach ($data as $off) {
            foreach ($off->offers as $key => $value) {
                $onlineOffers[$key] = [
                    'id' => $value->id,
                    'image_path' => $value->image_path,
                    'title' => $value->title,
                    'shop_id' => $value->shop_id,
                    'shop_image' => $value->shop->profile_path,
                    'shop_name' => $value->shop->name,
                    'category_id' => $value->shop->category->id,
                    'category_name' => $value->shop->category->name,
                    'category_image' => $value->shop->category->image_path,
                ];
            }
        }

        return [
            'online_offers' => $onlineOffers
        ];

    }

    public function offerDetails($id)
    {
        $data = Offers::where('id', $id)->get();

        return OfferResource::collection($data);
    }

    public function categoryOffers(Request $request)
    {
        $category_id = $request->category_id;
        $city_id = $request->city_id;
        $per_page = $request->per_page;

        $data = Shop::whereHas('cities', function($query) use ($city_id){
            $query->where('cities.id', $city_id);
        })->whereHas('category', function($query) use ($category_id){
            $query->where('category_id', $category_id);
        })->with('offers')->paginate($per_page);

        $categoryOffers = [];
        foreach ($data as $off) {
            foreach ($off->offers as $key => $value) {
                $categoryOffers[$key] = [
                    'id' => $value->id,
                    'image_path' => $value->image_path,
                    'title' => $value->title,
                    'shop_id' => $value->shop_id,
                    'shop_image' => $value->shop->profile_path,
                    'shop_name' => $value->shop->name,
                    'category_id' => $value->shop->category->id,
                    'category_name' => $value->shop->category->name,
                    'category_image' => $value->shop->category->image_path,
                ];
            }
        }



        if(empty($city_id)){
            $data = Shop::whereHas('category', function($query) use ($category_id){
                $query->where('category_id', $category_id);
            })->with('offers')->paginate($per_page);

            foreach ($data as $off) {
                foreach ($off->offers as $key => $value) {
                    $categoryOffers[$key] = [
                        'id' => $value->id,
                        'image_path' => $value->image_path,
                        'title' => $value->title,
                        'shop_id' => $value->shop_id,
                        'shop_image' => $value->shop->profile_path,
                        'shop_name' => $value->shop->name,
                        'category_id' => $value->shop->category->id,
                        'category_name' => $value->shop->category->name,
                        'category_image' => $value->shop->category->image_path,
                    ];
                }
            }

            return [
                'online_offers' => $categoryOffers
            ];

        }

        return [
            'online_offers' => $categoryOffers
        ];

    }

    public function addOffer(Request $request){
        $user = $request->user();
        $offer = new Offers();
        $offer->shop_id = $user->id;
        $offer->category_id = $request->category_id;

        $titles = ['en' => $request->title_en, 'ar' => $request->title];
        $offer->setTranslations('title', $titles);

        $descriptions = [
            'en' => $request->description_en,
            'ar' => $request->description,
        ];
        $offer->setTranslations('description', $descriptions);

        $offer->price = $request->price;
        $offer->discount = $request->discount;
        $offer->deadline = $request->deadline;

        // $offer->image_path = $offer_image_url;
        $offer->save();

        return response()->json([
            'message' => 'Offer created successfully',
            'offer' =>  $offer
        ], 201);

    }


    public function deleteOffer(Request $request){
        $user = $request->user();

        Offers::where('id', $request->id)->delete();

        return response()->json([
            'message' => 'Offer deleted successfully',
        ], 201);


    }

    public function likeOffer(Request $request){

        $mac = \exec('getmac');
        $mac2 = strtok($mac, ' ');

        $user = User::where('mac_add',  $mac2)->get();
        foreach($user as $user){
            $user = $user->id;
        }

        // return $user->id;

        if( empty($user)){
            $user = new User();
            $user->mac_add = $mac2;
            $user->save();
            return $user;
        }

        $likeOffer = new UserLikes();
        $likeOffer->user_id = $user;
        $likeOffer->offer_id = $request->offer_id;
        $likeOffer->save();

        $offer = Offers::find($request->offer_id);

        event(new likeOfferApi($offer));

        return response()->json([
            'message' => 'Offer Liked successfully',
            'offer' => $likeOffer
        ], 201);


    }

    public function unLikeOffer(Request $request){

        // return "1234";

        $mac = \exec('getmac');
        $mac2 = strtok($mac, ' ');

        $user = User::where('mac_add',  $mac2)->get();
        foreach($user as $user){
            $user = $user->id;
        }

        UserLikes::where('user_id', $user)->where('offer_id', $request->offer_id)->delete();

        return response()->json([
            'message' => 'Like deleted successfully'
        ], 201);

    }

    public function wishlist(){
        $mac = \exec('getmac');
        $mac2 = strtok($mac, ' ');
        $user = User::where('mac_add',  $mac2)->first();
        // foreach($user as $user){
        //     $user = $user->id;
        // }

        $data = UserLikes::with('offer')->where('user_id', $user->id)->get();

        return WishlistResource::collection($data);

    }


}
