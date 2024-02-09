<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index',['categories' => $categories]);
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $data = $request-> validate([
        'category_name' => 'required',
    ]);
    $newProduct = Category::create($data);
    return redirect(route('categories.index'));
    }

}
