<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){


        $data = Country::with('cities')->get();

        // if (count($data) < 1) {
        //     return response()->json([
        //         'status' => 204,
        //         'message' => 'No Countries'
        //     ]);
        // }

        return CountryResource::collection($data);
    }
}
