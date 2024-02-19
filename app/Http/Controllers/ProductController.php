<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Age;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        
        $products = Product::with('age')
            ->whereBetween('price', [$price_1, $price_2])
            ->whereIn('brand_id', $brand)
            ->whereIn('category_id', $category)
            ->whereIn('age_id', $age)
            ->whereIn('country_id', $country)
            ->where('product_name', 'like', '%' . $search . '%')
            ->orderBy($orderBy, $orderDirection)
            ->paginate(6)
            ->withQueryString();

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
        $product = Product::with('brand')
            ->with('category')
            ->with('age')
            ->with('country')
            ->where('id', $id)
            ->first();

        return view('customers.products.show', [
            'product' => $product
        ]);
    }

    public function cart()
    {
        return view('customers.carts.cart');
    }

    public function cartAjax()
    {
        return view('customers.carts.cartAjax');
    }

    public function addToCart(int $id)
    {
        $product = Product::with('brand')
            ->with('category')
            ->with('age')
            ->with('country')
            ->where('id', $id)
            ->first();

//        neu da co cart
        if (Session::exists('cart')) {
//            lay cart hien tai
            $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
//                them sp vao cart
                $cart = Arr::add($cart, $product->id, [
                    'image' => $product->image,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }
        } else {
//            tao cart moi
            $cart = array();
            $cart = Arr::add($cart, $product->id, [
                'image' => $product->image,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ]);
        }
//        nem cart len session
        Session::put(['cart' => $cart]);

        return Redirect::route('product.cart');
    }

    public function addToCartAjax(int $id)
    {
        $product = Product::with('brand')
            ->with('category')
            ->with('age')
            ->with('country')
            ->where('id', $id)
            ->first();

//        neu da co cart
        if (Session::exists('cart')) {
//            lay cart hien tai
            $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
//                them sp vao cart
                $cart = Arr::add($cart, $product->id, [
                    'image' => $product->image,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }
        } else {
//            tao cart moi
            $cart = array();
            $cart = Arr::add($cart, $product->id, [
                'image' => $product->image,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ]);
        }
//        nem cart len session
        Session::put(['cart' => $cart]);

        return Redirect::route('product.cartAjax');
    }

    public function updateCartQuantity(int $id, Request $request)
    {
        //        lay cart hien tai
        $cart = Session::get('cart');
//        cap nhat so luong
        $cart[$id]['quantity'] = $request->buy_quantity;
        //        cap nhat cart moi
        Session::put(['cart' => $cart]);
        return Redirect::back();
    }

    public function deleteFromCart(Request $request)
    {
//        lay cart hien tai
        $cart = Session::get('cart');
//        xoa id cua product can xoa
        Arr::pull($cart, $request->id);
//        cap nhat cart moi
        Session::put(['cart' => $cart]);

        return Redirect::back();
    }

    public function deleteAllFromCart()
    {
//       xoa cart
        Session::forget('cart');

        return Redirect::back();
    }

    public function checkout()
    {
        return view('customers.carts.checkout');
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
