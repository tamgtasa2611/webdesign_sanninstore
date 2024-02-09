<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Product_name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Description</td>
            <td>Image</td>
            <td>Brand_id</td>
            <td>age_id</td>
            <td>categories_id</td>
            <td>country_id</td>
            <td>Edit</td>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{$product -> id}}</td>
                <td>{{$product -> product_name}}</td>
                <td>{{$product -> quantity}}</td>
                <td>{{$product -> price}}</td>
                <td>{{$product -> description}}</td>
                <td><img src="{{ $product -> image }}" alt="" style="width: 50px;height:50px"></td>
                <td>@foreach ($brands as $brand)
                    @if ($product['brand_id'] == $brand['id'])
                        {{ $brand -> brand_name }}
                    @endif
                @endforeach</td>
                <td>@foreach ($ages as $age)
                    @if ($product['age_id'] == $age['id'])
                        {{$age -> age_name}}
                    @endif
                @endforeach</td>
                <td>@foreach($categories as $category)
                    @if($product['category_id'] == $category['id'])
                        {{ $category -> category_name }}
                    @endif
                @endforeach</td>
                <td>@foreach($countries as $country)
                    @if($product['country_id'] == $country['id'])
                        {{ $country -> country_name }}
                    @endif
                @endforeach</td>
                <td><a href="{{route('products.edit',['product' => $product])}}">Edit</a></td>
                <td>
                    <form method="post" action="{{ route('products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>