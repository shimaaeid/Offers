<?php

namespace App\Http\Controllers;

use App\Models\BestOffers;
use App\Http\Requests\StoreBestOffersRequest;
use App\Http\Requests\UpdateBestOffersRequest;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;

class BestOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $offers = BestOffers::all();
        $shops = Shop::all();
        $categories = Category::all();
        // dd("jkklhkj");
        return view(
            'admin.best_offers.index',
            compact('offers', 'shops', 'categories')
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
     * @param  \App\Http\Requests\StoreBestOffersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBestOffersRequest $request)
    {
        //
        // dd($request);
        try {
            $validated = $request->validated();

            // if ($validated->fails()) {
            //     return redirect()
            //         ->back()
            //         ->withErrors($validated)
            //         ->withInput();
            // }

            $offer = new BestOffers();
            $offer_image_url = '';

            if ($request->file('image_path')) {
                $offerImage = $request->file('image_path');
                $offerImageSaveAsName =
                    time() . $offerImage->getClientOriginalExtension();
                $upload_path = 'Attachments/BestOffers/';
                $offer_image_url = $upload_path . $offerImageSaveAsName;
                $success = $offerImage->move(
                    $upload_path,
                    $offerImageSaveAsName
                );
            }

            $offer->shop_id = $request->shop_id;
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
            $offer->priority = $request->priority;
            $offer->image_path = $offer_image_url;
            $offer->save();

            toastr()->success(trans('offers.add_success'));
            return redirect()->route('best-offers.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BestOffers  $bestOffers
     * @return \Illuminate\Http\Response
     */
    public function show(BestOffers $bestOffers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BestOffers  $bestOffers
     * @return \Illuminate\Http\Response
     */
    public function edit(BestOffers $bestOffers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBestOffersRequest  $request
     * @param  \App\Models\BestOffers  $bestOffers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBestOffersRequest $request)
    {
        //
        try {
            $validated = $request->validated();
            $offers = BestOffers::findOrFail($request->id);

            $offers->update([
                ($offers->shop_id = $request->shop_id),
                ($offers->category_id = $request->category_id),
                ($offers->title = [
                    'ar' => $request->title,
                    'en' => $request->title_en,
                ]),
                ($offers->description = [
                    'ar' => $request->description,
                    'en' => $request->description_en,
                ]),
                ($offers->price = $request->price),
                ($offers->discount = $request->discount),
                ($offers->priority = $request->priority),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('best-offers.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BestOffers  $bestOffers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $bestOffers = BestOffers::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('best-offers.index');
    }

    public function updateImageBestOffer(Request $request)
    {
        $bestOffers = BestOffers::find($request->id);

        $bestOffersImage = $request->file('image_path');
        $bestOffersImageSaveAsName =
            time() . $bestOffersImage->getClientOriginalExtension();

        $upload_path = 'Attachments/BestOffers/';
        $bestOffers_image_url = $upload_path . $bestOffersImageSaveAsName;
        $success = $bestOffersImage->move(
            $upload_path,
            $bestOffersImageSaveAsName
        );

        $bestOffers->update([
            'image_path' => $bestOffers_image_url,
        ]);

        toastr()->success(trans('bestOffers.edit_success'));
        return redirect()->route('best-offers.index');
    }
}
