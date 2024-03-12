<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(6);
        return view('admins.category_manager.index', [
            "categories" => $categories
        ]);
    }

    public function showDetail(Category $category)
    {
//        $category = Category::where('id', '=', $category->category_id)->first();
//        $category = Category::all();
//        $age = Age::all();
//        $country = Country::all();
        return view('admins.category_manager.category-detail', [
            'category' => $category,
//            'category' => $category,
//            'age' => $age,
//            'country' => $country
        ]);
    }

    public function create()
    {
        return view('admins.category_manager.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validate([
            'category_name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
        ]);
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/categories/';
            $file->move($path, $filename);
        }

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => $path . $filename,
        ]);
        return Redirect::route('category.index')->with('success', 'Add a category successfully!');

    }

    public function edit(Category $category)
    {
        return view('admins.category_manager.edit', [
            "category" => $category
        ]);
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        $data = $request->validate([
            'category_name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/categories/';
            $file->move($path, $filename);
            if (file_exists($category->image)) {
                unlink($category->image);
            }
        }

        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => $path . $filename,
        ]);
        return Redirect::route('category.index')->with('success', 'Edit a category successfully!');
    }

    public function destroy(Category $category)
    {
        //Xóa bản ghi được chọn
        $category->delete();
        //Quay về danh sách
        return Redirect::route('category.index')->with('success', 'Delete a category successfully!');
    }
}
