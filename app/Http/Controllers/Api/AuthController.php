<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Shop;
use App\Models\ShopCities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreShopRequest;
use App\Models\Admins;
use Hash;

class AuthController extends Controller
{
    //
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        \Config::set('auth.providers.users.model', App\Models\Shop::class);
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);

    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

         $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:shops',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|numeric|unique:shops,phone',
            'opening_hours' => 'nullable',
            'location' => 'nullable',
            'location_url' => 'nullable',
            'whatsapp' => 'nullable|numeric|unique:shops,whatsapp',
            'insta' => 'nullable|unique:shops,insta',
            'snap' => 'nullable|unique:shops,snap',
            'web_site' => 'nullable',
            'shoptype_id' => 'nullable',
            'months' => 'required',
            'subscription_date' => 'nullable',
            'expire_date' => 'nullable',
            'category_id' => 'nullable',
            'packagetype_id' => 'nullable',
            'description' => 'nullable',
            'profile_path' => 'nullable',
            'cover_path' => 'nullable',
         ]
        ,[
            'name.required' => trans('shops.name.required'),
            'email.required' => trans('shops.email.required'),
            'email.email' => trans('shops.email.email'),
            'email.unique' => trans('shops.email.unique'),
            'password.requied' => trans('shops.password.requied'),
            'password.confirmed' => trans('shops.password.confirmed'),
            'phone.required' => trans('shops.phone.required'),
            'phone.numeric' => trans('shops.phone.numeric'),
            'phone.unique' => trans('shops.phone.unique'),
            'whatsapp.numeric' => trans('shops.whatsapp.numeric'),
            'whatsapp.unique' => trans('shops.whatsapp.unique'),
            'insta.unique' => trans('shops.insta.unique'),
            'snap.unique' => trans('shops.snap.unique'),
            'months.required' => trans('shops.months.required'),
         ]
        );

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $shop = new Shop();

        $name = ['en' => $request->name_en, 'ar' => $request->name];
        $shop->setTranslations('name', $name);
        $shop->email = $request->email;
        $shop->password = Hash::make($request->password);
        $shop->phone = $request->phone;
        $shop->mac_add = \exec('getmac');

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

        $shop->save();

        //  return  count($request->city_id);
        // return count($cities);

        for ($i = 0; $i < count($request->get('city_id')); $i++) {
            ShopCities::create([
                'shop_id' => $shop->id,
                'city_id' => $request->get('city_id')[$i],
            ]);
        }

        if($request->shoptype_id == 3){
            $admin = new Admins();

            $name = ['en' => $request->name_en, 'ar' => $request->name];
            $admin->setTranslations('name', $name);
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->phone = $request->phone;
            $admin->mac_add = \exec('getmac');

            $opening = [
                'en' => $request->opening_hours_en,
                'ar' => $request->opening_hours,
            ];
            $admin->setTranslations('opening_hours', $opening);

            $location = [
                'en' => $request->location_en,
                'ar' => $request->location,
            ];
            $admin->setTranslations('location', $location);

            $admin->location_url = $request->location_url;
            $admin->whatsapp = $request->whatsapp;
            $admin->insta = $request->insta;
            $admin->snap = $request->snap;
            $admin->web_site = $request->web_site;
            $admin->shoptype_id = $request->shoptype_id;
            $admin->months = $request->months;
            $admin->subscription_date =  Carbon::now();
            $admin->expire_date =Carbon::now()->addMonths($admin->months);
            $admin->category_id = $request->category_id;
            $description = [
                'en' => $request->description_en,
                'ar' => $request->description,
            ];
            $admin->setTranslations('description', $description);
            $admin->packagetype_id = $request->packagetype_id;

            $admin->save();

            //  return  count($request->city_id);
            // return count($cities);

            // for ($i = 0; $i < count($request->get('city_id')); $i++) {
            //     ShopCities::create([
            //         'shop_id' => $admin->id,
            //         'city_id' => $request->get('city_id')[$i],
            //     ]);
            // }

        }

        return response()->json([
            'message' => 'Shop successfully registered',
            'shop' => $shop
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Shop successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function updateProfile(Request $request){

         $user = $request->user();


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:shops',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|numeric|unique:shops,phone',
            'opening_hours' => 'nullable',
            'location' => 'nullable',
            'location_url' => 'nullable',
            'whatsapp' => 'nullable|numeric|unique:shops,whatsapp',
            'insta' => 'nullable|unique:shops,insta',
            'snap' => 'nullable|unique:shops,snap',
            'web_site' => 'nullable',
            'shoptype_id' => 'nullable',
            'months' => 'required',
            'subscription_date' => 'nullable',
            'expire_date' => 'nullable',
            'category_id' => 'nullable',
            'packagetype_id' => 'nullable',
            'description' => 'nullable',
            'profile_path' => 'nullable',
            'cover_path' => 'nullable',
         ]
        ,[
            'name.required' => trans('shops.name.required'),
            'email.required' => trans('shops.email.required'),
            'email.email' => trans('shops.email.email'),
            'email.unique' => trans('shops.email.unique'),
            'password.requied' => trans('shops.password.requied'),
            'password.confirmed' => trans('shops.password.confirmed'),
            'phone.required' => trans('shops.phone.required'),
            'phone.numeric' => trans('shops.phone.numeric'),
            'phone.unique' => trans('shops.phone.unique'),
            'whatsapp.numeric' => trans('shops.whatsapp.numeric'),
            'whatsapp.unique' => trans('shops.whatsapp.unique'),
            'insta.unique' => trans('shops.insta.unique'),
            'snap.unique' => trans('shops.snap.unique'),
            'months.required' => trans('shops.months.required'),
         ]
        );

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $shop = shop::findOrFail($user->id);

        $shop->update([
            $shop->name = ['en' => $request->name_en, 'ar' => $request->name],
            // $shop->setTranslations('name', $name);
            $shop->email = $request->email,
            $shop->password = Hash::make($request->password),
            $shop->phone = $request->phone,
            $shop->mac_add = \exec('getmac'),

            $shop->opening_hours = [
                'en' => $request->opening_hours_en,
                'ar' => $request->opening_hours,
            ],
            // $shop->setTranslations('opening_hours', $opening);

            $shop->location = [
                'en' => $request->location_en,
                'ar' => $request->location,
            ],
            // $shop->setTranslations('location', $location);

            $shop->location_url = $request->location_url,
            $shop->whatsapp = $request->whatsapp,
            $shop->insta = $request->insta,
            $shop->snap = $request->snap,
            $shop->web_site = $request->web_site,
            $shop->shoptype_id = $request->shoptype_id,
            $shop->months = $request->months,
            $shop->subscription_date =  Carbon::now(),
            $shop->expire_date =Carbon::now()->addMonths($shop->months),
            $shop->category_id = $request->category_id,
            $shop->description = [
                'en' => $request->description_en,
                'ar' => $request->description,
            ],
            // $shop->setTranslations('description', $description);
            $shop->packagetype_id = $request->packagetype_id,


        ]);


        // $shop->save();

        //  return  count($request->city_id);
        // return count($cities);

        for ($i = 0; $i < count($request->get('city_id')); $i++) {
            ShopCities::where('shop_id', $user->id)->update([
                'shop_id' => $shop->id,
                'city_id' => $request->get('city_id')[$i],
            ]);
        }

        return response()->json([
            'message' => 'Shop successfully updated',
            'user' => $shop
        ], 201);

    }


}
