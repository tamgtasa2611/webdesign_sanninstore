<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //show all products
    public function index(Request $request)
    {
        //search
        $search = "";
        if (isset($request->search)) {
            $search = $request->search;
        }
        //filter
        $price_1 = 0;
        $price_2 = 9999;
        if ($request->price_1 != null) {
            $price_1 = $request->price_1;
        }
        if ($request->price_2 != null) {
            $price_2 = $request->price_2;
        }
        if ($price_1 > $price_2) {
            $bigger = $price_1;
            $price_1 = $price_2;
            $price_2 = $bigger;
        }

        $brand = Brand::all('id')->toArray();
        if (isset($request->brand)) {
            $brand = $request->brand;
        }

        $category = Category::all('id')->toArray();
        if (isset($request->category)) {
            $category = $request->category;
        }

        $age = Age::all('id')->toArray();
        if (isset($request->age)) {
            $age = $request->age;
        }

        $country = Country::all('id')->toArray();
        if (isset($request->country)) {
            $country = $request->country;
        }

        //sorting
        $sorting = 'default';
        if (isset($request->sorting)) {
            $sorting = $request->sorting;
        }
        $orderBy = "id";
        $orderDirection = "asc";
        switch ($sorting) {
            case 'newest':
                $orderDirection = "desc";
                break;
            case 'bestseller':
                //bestseller de lai khi nao lam xong order tinh sau
                break;
            case 'low_to_high':
                $orderBy = "price";
                break;
            case 'high_to_low':
                $orderBy = "price";
                $orderDirection = "desc";
                break;
        }

//        cach 1 loi filter
//        $products = Product::all()->filter(request('search'))->paginate(3);
        $products = DB::table('products')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('ages', 'products.age_id', 'ages.id')
            ->join('countries', 'products.country_id', 'countries.id')
            ->select('products.*', 'brands.brand_name', 'categories.category_name', 'ages.age_name', 'countries.country_name')
            ->whereBetween('price', [$price_1, $price_2])
            ->whereIn('brand_id', $brand)
            ->whereIn('category_id', $category)
            ->whereIn('country_id', $country)
            ->whereIn('age_id', $age)
            ->where('product_name', 'like', '%' . $search . '%')
            ->orderBy($orderBy, $orderDirection)
            ->paginate(6)
            ->withQueryString();
//        cach 3 khong join duoc
//        $products = Product::paginate(6);

        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();
        $ages = Age::all();

        return view('customers.products.index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'countries' => $countries,
            'ages' => $ages,
            'search' => $search,
            'sorting' => $sorting,
            'f_price_1' => $price_1,
            'f_price_2' => $price_2,
            'f_brand' => $brand,
            'f_category' => $category,
            'f_country' => $country,
            'f_age' => $age
        ]);
    }

    public function show(int $id)
    {
        $product = DB::table('products')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('ages', 'products.age_id', 'ages.id')
            ->join('countries', 'products.country_id', 'countries.id')
            ->select('products.*', 'brands.brand_name', 'categories.category_name', 'ages.age_name', 'countries.country_name')
            ->where('products.id', '=', $id)
            ->first();

        return view('customers.products.show', [
            'product' => $product
        ]);
    }

//    ADMIN
    public function indexAdmins()
    {
        $products = Product::all();
        $categories = Category::all();
        $ages = Age::all();
        $countries = Country::all();
        $brands = Brand::all();
        return view('products.index', compact('products', 'categories', 'ages', 'countries', 'brands'));
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'age_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ]);
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/products/';
            $file->move($path, $filename);

        }

        Product::create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path . $filename,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'age_id' => $request->age_id,
            'brand_id' => $request->brand_id,
        ]);
        return redirect(route('products.index'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }


    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'age_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/products/';
            $file->move($path, $filename);
            if (file_exists($product->image)) {
                unlink($product->image);
            }
        }

        $product->update([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path . $filename,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'age_id' => $request->age_id,
            'brand_id' => $request->brand_id,
        ]);
        return redirect(route('products.index'));
    }

    public function destroy(Product $products, Request $request)
    {
        //Xóa bản ghi được chọn
        $products->delete();
        //Quay về danh sách
        return redirect(route('products.index'));
    }
}
