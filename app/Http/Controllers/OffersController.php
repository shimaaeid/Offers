<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use App\Http\Requests\StoreOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offers = Offers::all();
        $shops = Shop::all();
        $categories = Category::all();

        return view(
            'admin.offers.index',
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
     * @param  \App\Http\Requests\StoreOffersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffersRequest $request)
    {
        //
        // return $request->all();

        try {
            $validated = $request->validated();
            $offer = new Offers();

            $offer_image_url = '';

            if ($request->file('image_path')) {
                $offerImage = $request->file('image_path');
                $offerImageSaveAsName =
                    time() . $offerImage->getClientOriginalExtension();

                $upload_path = 'Attachments/Offers/';
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
            $offer->deadline = $request->deadline;

            $offer->image_path = $offer_image_url;
            $offer->save();
            toastr()->success(trans('offers.add_success'));
            return redirect()->route('offers.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function show(Offers $offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function edit(Offers $offers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffersRequest  $request
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffersRequest $request)
    {
        //
        try {
            $validated = $request->validated();
            $offers = Offers::findOrFail($request->id);

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
                ($offers->deadline = $request->deadline),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('offers.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $offer = Offers::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('offers.index');
    }

    public function updateOfferImage(Request $request)
    {
        $offer = Offers::find($request->id);

        $offerImage = $request->file('image_path');
        $offerImageSaveAsName =
            time() . $offerImage->getClientOriginalExtension();

        $upload_path = 'Attachments/Offers/';
        $offer_image_url = $upload_path . $offerImageSaveAsName;
        $success = $offerImage->move($upload_path, $offerImageSaveAsName);

        $offer->update([
            'image_path' => $offer_image_url,
        ]);

        toastr()->success(trans('offers.edit_success'));
        return redirect()->route('offers.index');
    }
}
