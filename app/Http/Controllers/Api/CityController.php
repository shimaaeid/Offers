<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCityResource;
use App\Http\Resources\CityResource;
use App\Models\BestOffers;
use App\Models\Category;
use App\Models\ShopCities;

class CityController extends Controller
{
    //
    public function cities($id)
    {
        $data = City::where('country_id', $id)->get();

        // if (count($data) < 1) {
        //     return response()->json([
        //         'status' => 204,
        //         'message' => 'No Attributes'
        //     ]);
        // }
        return CityResource::collection($data);
    }

    // public function categoryiesOfCity($id = null)
    // {
    //     $data = Category::with([
    //         'topLikedOffers' => function ($query) {
    //             $query
    //                 ->orderBy('likes', 'desc')
    //                 ->limit(25)
    //                 ->get();
    //         },
    //         'shops' => function ($query) {
    //             $query
    //                 ->orderBy('watched')
    //                 ->limit(25)
    //                 ->get();
    //         },
    //         'bestOffers',
    //     ])->get();
    //     $best_offers = [];
    //     if(count($data) < 1){
    //         $data = Category::with('bestOffers')->get();

    //         foreach ($data as $cat) {
    //             foreach ($cat->bestOffers as $key => $row) {
    //                 $best_offers[$key] = [
    //                     'id' => $row->id,
    //                     'image' => $row->image_path,
    //                     'title' => $row->title,
    //                     'shop_id' => $row->shop->id,
    //                     'shop_image' => $row->shop->profile_path,
    //                     'name' => $row->shop->name,
    //                     'category_id' => $row->category->id,
    //                     'category_name' => $row->category->name,
    //                     'category_image' => $row->category->image_path,
    //                 ];
    //             }

    //         }

    //     }
    //     return ['best_offers' => $best_offers];

    //     // $top_offers_liked = $top_watched = $best_offers = [];
    //     // if ($id) {
    //     //     $data = Category::whereHas('shops', function ($query) use ($id) {
    //     //         $query->whereHas('cities', function ($query) use ($id) {
    //     //             $query->where('cities.id', $id);
    //     //         });
    //     //     })
    //     //         ->with([
    //     //             'topLikedOffers' => function ($query) {
    //     //                 $query
    //     //                     ->orderBy('likes', 'desc')
    //     //                     ->limit(25)
    //     //                     ->get();
    //     //             },
    //     //             'shops' => function ($query) use ($id) {
    //     //                 $query->whereHas('cities', function ($query) use ($id) {
    //     //                     $query
    //     //                         ->where('cities.id', $id)
    //     //                         ->orderBy('watched', 'desc')
    //     //                         ->limit(25);
    //     //                 });
    //     //             },
    //     //             'bestOffers',
    //     //         ])
    //     //         ->get();

    //     //     $top_offers_liked = $top_watched = $best_offers = [];
    //     //     foreach ($data as $cat) {
    //     //         foreach ($cat->topLikedOffers as $key => $row) {
    //     //             $top_offers_liked[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image_path' => $row->image_path,
    //     //                 'title' => $row->title,
    //     //                 'shop_id' => $row->shop_id,
    //     //                 'shop_image' => $row->shop->profile_path,
    //     //                 'shop_name' => $row->shop->name,
    //     //                 'category_id' => $row->shop->category->id,
    //     //                 'category_name' => $row->shop->category->name,
    //     //                 'category_image' => $row->shop->category->image_path,
    //     //                 // 'likes' =>  $row->likes
    //     //             ];
    //     //         }

    //     //         foreach ($cat->shops as $key => $row) {
    //     //             $top_watched[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image' => $row->profile_path,
    //     //                 'name' => $row->name,
    //     //                 'category_id' => $row->category->id,
    //     //                 'category_name' => $row->category->name,
    //     //                 'category_image' => $row->category->image_path,
    //     //             ];
    //     //         }

    //     //         foreach ($cat->bestOffers as $key => $row) {
    //     //             $best_offers[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image' => $row->image_path,
    //     //                 'title' => $row->title,
    //     //                 'shop_id' => $row->shop->id,
    //     //                 'shop_image' => $row->shop->profile_path,
    //     //                 'name' => $row->shop->name,
    //     //                 'category_id' => $row->category->id,
    //     //                 'category_name' => $row->category->name,
    //     //                 'category_image' => $row->category->image_path,
    //     //             ];
    //     //         }
    //     //     }

    //     //     return [
    //     //         'categories' => CategoryCityResource::collection($data),
    //     //         'top_offers_liked' => $top_offers_liked,
    //     //         'top_watched' => $top_watched,
    //     //         'best_offers' => $best_offers,
    //     //     ];

    //     // }
    //     // elseif($id == null){

    //     //     $data = Category::with([
    //     //         'topLikedOffers' => function ($query) {
    //     //             $query
    //     //                 ->orderBy('likes', 'desc')
    //     //                 ->limit(25)
    //     //                 ->get();
    //     //         },
    //     //         'shops' => function ($query) {
    //     //             $query
    //     //                 ->orderBy('watched')
    //     //                 ->limit(25)
    //     //                 ->get();
    //     //         },
    //     //         'bestOffers',
    //     //     ])->get();

    //     //     foreach ($data as $cat) {
    //     //         foreach ($cat->topLikedOffers as $key => $row) {
    //     //             $top_offers_liked[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image_path' => $row->image_path,
    //     //                 'title' => $row->title,
    //     //                 'shop_id' => $row->shop_id,
    //     //                 'shop_image' => $row->shop->profile_path,
    //     //                 'shop_name' => $row->shop->name,
    //     //                 'category_id' => $row->shop->category->id,
    //     //                 'category_name' => $row->shop->category->name,
    //     //                 'category_image' => $row->shop->category->image_path,
    //     //                 // 'likes' =>  $row->likes
    //     //             ];
    //     //         }

    //     //         foreach ($cat->shops as $key => $row) {
    //     //             $top_watched[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image' => $row->profile_path,
    //     //                 'name' => $row->name,
    //     //                 'category_id' => $row->category->id,
    //     //                 'category_name' => $row->category->name,
    //     //                 'category_image' => $row->category->image_path,
    //     //             ];
    //     //         }

    //     //         foreach ($cat->bestOffers as $key => $row) {
    //     //             $best_offers[$key] = [
    //     //                 'id' => $row->id,
    //     //                 'image' => $row->image_path,
    //     //                 'title' => $row->title,
    //     //                 'shop_id' => $row->shop->id,
    //     //                 'shop_image' => $row->shop->profile_path,
    //     //                 'name' => $row->shop->name,
    //     //                 'category_id' => $row->category->id,
    //     //                 'category_name' => $row->category->name,
    //     //                 'category_image' => $row->category->image_path,
    //     //             ];
    //     //         }
    //     //     }

    //     //     return [
    //     //         'categories' => CategoryCityResource::collection($data),
    //     //         'top_offers_liked' => $top_offers_liked,
    //     //         'top_watched' => $top_watched,
    //     //         'best_offers' => $best_offers,
    //     //     ];

    //     // }
    // }

    public function categoriesCity($id = null)
    {
        $data = Category::whereHas('shops', function ($query) use ($id) {
            $query->whereHas('cities', function ($query) use ($id) {
                $query->where('cities.id', $id);
            });
        })
            ->with([
                'topLikedOffers' => function ($query) {
                    $query
                        ->orderBy('likes', 'desc')
                        ->limit(25)
                        ->get();
                },
                'shops' => function ($query) use ($id) {
                    $query->whereHas('cities', function ($query) use ($id) {
                        $query
                            ->where('cities.id', $id)
                            ->orderBy('watched', 'desc')
                            ->limit(25);
                    });
                },
                'bestOffers',
            ])
            ->get();

        $top_offers_liked = $top_watched = $best_offers = [];
        foreach ($data as $cat) {
            foreach ($cat->topLikedOffers as $key => $row) {
                $top_offers_liked[$key] = [
                    'id' => $row->id,
                    'image_path' => $row->image_path,
                    'title' => $row->title,
                    'shop_id' => $row->shop_id,
                    'shop_image' => $row->shop->profile_path,
                    'shop_name' => $row->shop->name,
                    'category_id' => $row->shop->category->id,
                    'category_name' => $row->shop->category->name,
                    'category_image' => $row->shop->category->image_path,
                    // 'likes' =>  $row->likes
                ];
            }

            foreach ($cat->shops as $key => $row) {
                $top_watched[$key] = [
                    'id' => $row->id,
                    'image' => $row->profile_path,
                    'name' => $row->name,
                    'category_id' => $row->category->id,
                    'category_name' => $row->category->name,
                    'category_image' => $row->category->image_path,
                ];
            }

            foreach ($cat->bestOffers as $key => $row) {
                $best_offers[$key] = [
                    'id' => $row->id,
                    'image' => $row->image_path,
                    'title' => $row->title,
                    'shop_id' => $row->shop->id,
                    'shop_image' => $row->shop->profile_path,
                    'name' => $row->shop->name,
                    'category_id' => $row->category->id,
                    'category_name' => $row->category->name,
                    'category_image' => $row->category->image_path,
                ];
            }
        }

        if (empty($id)) {
            $data = Category::with([
                'topLikedOffers' => function ($query) {
                    $query
                        ->orderBy('likes', 'desc')
                        ->limit(25)
                        ->get();
                },
                'shops' => function ($query) {
                    $query
                        ->orderBy('watched')
                        ->limit(25)
                        ->get();
                },
                'bestOffers',
            ])->get();
            foreach ($data as $cat) {
                foreach ($cat->topLikedOffers as $key => $row) {
                    $top_offers_liked[$key] = [
                        'id' => $row->id,
                        'image_path' => $row->image_path,
                        'title' => $row->title,
                        'shop_id' => $row->shop_id,
                        'shop_image' => $row->shop->profile_path,
                        'shop_name' => $row->shop->name,
                        'category_id' => $row->shop->category->id,
                        'category_name' => $row->shop->category->name,
                        'category_image' => $row->shop->category->image_path,
                        // 'likes' =>  $row->likes
                    ];
                }

                foreach ($cat->shops as $key => $row) {
                    $top_watched[$key] = [
                        'id' => $row->id,
                        'image' => $row->profile_path,
                        'name' => $row->name,
                        'category_id' => $row->category->id,
                        'category_name' => $row->category->name,
                        'category_image' => $row->category->image_path,
                    ];
                }

                foreach ($cat->bestOffers as $key => $row) {
                    $best_offers[$key] = [
                        'id' => $row->id,
                        'image' => $row->image_path,
                        'title' => $row->title,
                        'shop_id' => $row->shop->id,
                        'shop_image' => $row->shop->profile_path,
                        'name' => $row->shop->name,
                        'category_id' => $row->category->id,
                        'category_name' => $row->category->name,
                        'category_image' => $row->category->image_path,
                    ];
                }
            }
            return [
                'categories' => CategoryCityResource::collection($data),
                'top_offers_liked' => $top_offers_liked,
                'top_watched' => $top_watched,
                'best_offers' => $best_offers,
            ];
        }

        if (count($data) < 1) {
            $data = BestOffers::all();
            $best_offers = [];
            foreach ($data as $key => $row) {
                $best_offers[$key] = [
                    'id' => $row->id,
                    'image' => $row->image_path,
                    'title' => $row->title,
                    'shop_id' => $row->shop->id,
                    'shop_image' => $row->shop->profile_path,
                    'name' => $row->shop->name,
                    'category_id' => $row->category->id,
                    'category_name' => $row->category->name,
                    'category_image' => $row->category->image_path,
                ];
            }
            return [
                'best_offers' => $best_offers,
            ];
        }

        return [
            'categories' => CategoryCityResource::collection($data),
            'top_offers_liked' => $top_offers_liked,
            'top_watched' => $top_watched,
            'best_offers' => $best_offers,
        ];
    }
}
