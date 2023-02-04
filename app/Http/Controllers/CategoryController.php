<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        if (
            Category::where('name->ar', $request->name)
                ->orWhere('name->en', $request->name_en)
                ->exists()
        ) {
            return redirect()
                ->back()
                ->withErrors(trans('categories.exists'));
        }
        try {
            $validated = $request->validated();
            $category = new Category();

            $category_image_url = '';

            if($request->file('image_path')){
                $categoryImage = $request->file('image_path');
                $categoryImageSaveAsName =
                    time() . $categoryImage->getClientOriginalExtension();

                $upload_path = 'Attachments/Categories/';
                $category_image_url = $upload_path . $categoryImageSaveAsName;
                $success = $categoryImage->move(
                    $upload_path,
                    $categoryImageSaveAsName
                );

            }



            $translations = ['en' => $request->name_en, 'ar' => $request->name];
            $category->setTranslations('name', $translations);

            $category->image_path = $category_image_url;
            $category->save();
            toastr()->success(trans('categories.add_success'));
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request)
    {
        //
        try {
            $validated = $request->validated();
            $category = Category::findOrFail($request->id);

            $category->update([(

                    $category->name = [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                    ]
            ),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $category = Category::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('categories.index');
    }

    public function updateImage(Request $request)
    {
        $category = Category::find($request->id);

        $categoryImage = $request->file('image_path');
        $categoryImageSaveAsName =
            time() . $categoryImage->getClientOriginalExtension();

        $upload_path = 'Attachments/Categories/';
        $category_image_url = $upload_path . $categoryImageSaveAsName;
        $success = $categoryImage->move($upload_path, $categoryImageSaveAsName);

        $category->update([
            'image_path' => $category_image_url,
        ]);

       toastr()->success(trans('categories.edit_success')) ;
        return redirect()->route('categories.index');
    }
}
