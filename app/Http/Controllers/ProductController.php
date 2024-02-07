<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    //show all products
    public function index()
    {
//        cach 1 loi
//        $products = Product::all()->filter(request('search'))->paginate(3);
//        cach 2 ko phai mvc
//        $products = DB::table('products')->paginate(3);
        $products = Product::paginate(6);

        return view('customers.products.index', [
            'products' => $products
        ]);
        
    }
    // public function index(){
    //     return view('products.index');
    // }

    // public function create(){
    //     return view('products.create');
    // }
    // public function store(Request $request){
    //     dd($request);
    // }
    public function indexAdmins(){
        $products = Product::all();
         return view('products.index',['products' => $products]);
     }

     public function create(){
         return view('products.create');
     }
     public function store(Request $request){
        $data = $request-> validate([
        'product_name' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        'description' => 'required',
        // 'image' => 'required',
        'category_id' => 'required|numeric',
        'country_id' => 'required|numeric',
        'age_id' => 'required|numeric',
        'brand_id' => 'required|numeric',
    ]);
        $newProduct = Product::create($data);
        return redirect(route('products.index'));
    }
    public function edit(Product $product){
        return view('products.edit' , ['product' => $product]);
    }
    public function update(Product $product,Request $request){
        $data = $request-> validate([
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
            // 'image' => 'required',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'age_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ]);
        
        $product -> update($data);
        return redirect(route('products.index'));
    }
    public function destroy(Product $product, Request $request)
    {
        //Xóa bản ghi được chọn
        $product->delete();
        //Quay về danh sách
        return redirect(route('products.index'));
    }
}
