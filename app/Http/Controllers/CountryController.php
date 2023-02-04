<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\City;
use DB;
use App\Http\Resources\CityResource;
use App\Traits\ImageTrait;

class CountryController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
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
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        //
        $validated = $request->validated();
        if (
            Country::where('name->ar', $request->name)
                ->orWhere('name->en', $request->name_en)
                ->exists()
        ) {
            return response()->json([
                'message' => 'test'
            ], 500);
        }
        try {
            $country = new Country();
            $country_flag_url = '';
            if($request->file('flag')){
                $country_flag_url = $this->saveImage($request->file('flag'), 'public/Attachments/CountryFlag/');
            }
            $translations = ['en' => $request->name_en, 'ar' => $request->name];
            $country->setTranslations('name', $translations);
            $country->flag = $country_flag_url;
            $country->save();
            toastr()->success(trans('countries.add_success'));
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, int $test)
    {
        //
        try {
            $validated = $request->validated();
            $country = Country::findOrFail($request->id);
            $country->update([
                ($country->name = [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ]),
            ]);
            toastr()->success(trans('messages.Update'));
            return response()->json([
                'message' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $country = Country::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('countries.index');
    }

    public function getCities($id)
    {
        $cities = City::where('country_id', $id)->get();
        return CityResource::collection($cities);
    }

    public function updateFlag(Request $request)
    {
        $country = Country::find($request->id);

        $country_flag_url = $this->saveImage($request->file('flag'), 'public/Attachments/CountryFlag/');


        $country->update([
            'flag' => $country_flag_url,
        ]);

        toastr()->success(trans('countries.edit_success'));
        return redirect()->route('countries.index');
    }
}
