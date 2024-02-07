<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 {{-- product_name, quantity, price, description, image, category_id, country_id, age_id, brand_id --}}
    
 <h1>Editing</h1>
    <form action="{{ route('products.update',['product' => $product]) }}" method="POST">
     @csrf
    <!--put để update-->
    @method('PUT')
           <div>
            <label for="name">Product Name</label>
            <input type="text" name="product_name" placeholder="Name" value="{{$product -> product_name}}">
           </div>
           <div>
            <label for="">Quantity</label>
            <input type="number" name="quantity" placeholder="Quantity"value="{{$product -> quantity}}">
           </div>
           <div>
            <label for="">Price</label>
            <input type="number" name="price" placeholder="Price"value="{{$product -> price}}">
           </div>
           <div>
            <label for="">Description</label>
            <input type="text" name="description" placeholder="description"value="{{$product -> description}}">
           </div>
           {{-- <div>
            <label for="">Image</label>
            <input type="number" name="image" placeholder="image">
           </div> --}}
           <div>
            {{-- <label for="">Categories</label>
            <br>
            <input type="radio" name="categories_id" value ="1">
            <label for="Batman">Batman</label>
            <input type="radio" name="categories_id" value ="2">
            <label for="Minecraft">Minecraft</label>
            <input type="radio" name="categories_id" value ="3">
            <label for="Lunar New Year">Lunar New Year</label>
            <input type="radio" name="categories_id" value ="4">
            <label for="Valentine">Valentine</label>
            <input type="radio" name="categories_id" value ="5">
            <label for="Disney">Disney</label>
            <input type="radio" name="categories_id" value ="6">
            <label for="Marvel">Marvel</label>
           </div>
<br>
           <div>
            <label for="">Brand</label>
            <br>
            <input type="radio" name="categories_id" value ="1">
            <label for="Mojang Studios">Mojang Studios</label>
            <input type="radio" name="categories_id" value ="2">
            <label for="Disney">Disney</label>
            <input type="radio" name="categories_id" value ="3">
            <label for="Marvel">Marvel</label>
            <input type="radio" name="categories_id" value ="4">
            <label for="Valentine">DC</label>
            <input type="radio" name="categories_id" value ="5">
            <label for="Sega">Sega</label>
            <input type="radio" name="categories_id" value ="6">
            <label for="Nintendo">Nintendo</label>
           </div>
           <br>
           <div>
            <label for="">Ages</label>
            <br>
            <input type="radio" name="categories_id" value ="1">
            <label for="1.5+">1.5+</label>
            <input type="radio" name="categories_id" value ="2">
            <label for="4+">4+</label>
            <input type="radio" name="categories_id" value ="3">
            <label for="6+">6+</label>
            <input type="radio" name="categories_id" value ="4">
            <label for="9+">9+</label>
            <input type="radio" name="categories_id" value ="5">
            <label for="13+">13+</label>
            <input type="radio" name="categories_id" value ="6">
            <label for="18+">18+</label>
           </div>
           <label for="category_id">Category:</label> --}}
    <div>
    <select id="category_id" name="category_id" required value="{{$product -> category_id}}">
        <option value="1">Batman</option>
        <option value="2">Minecraft</option>
        <option value="3">Lunar New Year</option>
        <option value="4">Valentine</option>
        <option value="5">Disney</option>
        <option value="6">Marvel</option>
        <!-- Add other categories as needed -->
    </select><br>
    </div>
    <div>
    <label for="country_id">Country:</label>
    <select id="country_id" name="country_id" required value="{{$product -> country_id}}">
        <option value="1">United States</option>
        <option value="2">Korea</option>
        <option value="3">Italy</option>
        <option value="4">China</option>
        <option value="5">Japan</option>
        <option value="6">Viet Nam</option>
        <!-- Add other countries as needed -->
    </select><br>
    </div>
    <div>
    <label for="age_id">Age:</label>
    <select id="age_id" name="age_id" required value="{{$product -> age_id}}">
        <option value="1">1.5+</option>
        <option value="2">4+</option>
        <option value="3">6+</option>
        <option value="4">9+</option>
        <option value="5">13+</option>
        <option value="6">18+</option>
        <!-- Add other age groups as needed -->
    </select><br>
    </div>
    <div>
    <label for="brand_id">Brand:</label>
    <select id="brand_id" name="brand_id" required value="{{$product -> brand_id}}">
        <option value="1">Mojang Studios</option>
        <option value="2">Disney</option>
        <option value="4">DC</option>
        <option value="5">Sega</option>
        <option value="6">Nintendo</option>
        <option value="3">Marvel</option>
        <!-- Add other brands as needed -->
    </select><br>
    </div>
    <button>ADD</button>
    </form>
</body>
</html>