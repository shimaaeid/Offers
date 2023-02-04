<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all();
        $countries = Country::all();
        return view('admin.cities.index', compact('cities', 'countries'));
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
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        //
        if(City::where('name->ar' , $request->name)->orWhere('name->en', $request->name_en)->exists()){
            return redirect()->back()->withErrors(trans('cities.exists'));
      
          }
        try {
            $validated = $request->validated();
            $city = new City();

            $translations = ['en' => $request->name_en, 'ar' => $request->name];
            $city->setTranslations('name', $translations);
            $city->location = $request->location;
            $city->country_id = $request->country_id;
            $city->save();
            toastr()->success(trans('cities.add_success'));
            return redirect()->route('cities.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request)
    {
        //
        try {
            $validated = $request->validated();
            $city = City::findOrFail($request->id);
            $city->update([
                ($city->name = [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ]),
                ($city->location = $request->location),
                ($city->country_id = $request->country_id),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('cities.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // return $request->all;
        $city = City::findOrFail($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->route('cities.index');
    }
}
