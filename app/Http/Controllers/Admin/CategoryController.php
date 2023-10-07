<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\Save_photos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use Save_photos;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    public function index()
    {

        $categories = Category::with('SuperCategory')->get();
        return view('Admin.Categories.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $main = SuperCategory::get();
        return view('Admin.Categories.Crud-Category.create', compact('main'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'main_category_id' => 'required',
            'photo' => 'required|image',
        ]);
        $data = $request->except('photo');
        $photo = $request->file('photo');
        $data['photo'] = $this->save_photo('category_photos', $photo);
        Category::create($data);
        notify()->success('Created Category Success !!', 'Creatation');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $main = SuperCategory::get();
        return view('Admin.Categories.Crud-Category.edit', compact('category', 'main'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:150',
            'main_category_id' => 'required',
            'photo' => 'required|image',
        ]);
        if ($request->has('photo')) {
            $data = $request->except('photo');
            $new_photo = $request->file('photo');
            $old_photo = $category->photo;
            $data['photo'] = $this->save_photo('category_photos', $new_photo);
            $category->update($data);
            Storage::disk("Image")->delete($old_photo);
        } else {
            $category->update($request->all());
        }
        notify()->success('Updated Category Success !!', 'Updating');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $old_photo = $category->photo;
        $category->delete();
        Storage::disk("Images")->delete($old_photo);
        notify()->success('Deleted Category Success !!', 'Deleting');
        return redirect()->route('category.index');
    }
}
