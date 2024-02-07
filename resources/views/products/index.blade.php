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
                <td>{{$product -> image}}</td>
                <td>{{$product -> brand_id}}</td>
                <td>{{$product -> age_id}}</td>
                <td>{{$product -> category_id}}</td>
                <td>{{$product -> country_id}}</td>
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