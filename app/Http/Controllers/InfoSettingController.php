<?php

namespace App\Http\Controllers;

use App\Models\InfoSetting;
use App\Http\Requests\StoreInfoSettingRequest;
use App\Http\Requests\UpdateInfoSettingRequest;

class InfoSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings = InfoSetting::all();

        return view('admin.settings.index', compact('settings'));
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
     * @param  \App\Http\Requests\StoreInfoSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInfoSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Http\Response
     */
    public function show(InfoSetting $infoSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoSetting $infoSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInfoSettingRequest  $request
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoSettingRequest $request)
    {
        //

        try {
            $validated = $request->validated();
            $settings = InfoSetting::findOrFail($request->id);

            $settings->update([

                    ($settings->forceUpdate = $request->forceUpdate),
                    ($settings->lastBuild = $request->lastBuild),
                    ($settings->website = $request->website),
                    ($settings->whatsApp = $request->whatsApp),
                    ($settings->phone = $request->phone),
                    ($settings->snap = $request->snap),
                    ($settings->Instagram = $request->Instagram),
                    ($settings->ticktock = $request->ticktock),
                    ($settings->policy = $request->policy),
                    ($settings->android = $request->android),
                    ($settings->ios = $request->ios),

            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('settings.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoSetting $infoSetting)
    {
        //
    }
}
