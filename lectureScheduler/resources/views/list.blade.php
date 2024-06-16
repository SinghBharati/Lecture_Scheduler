<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of Products</title>
</head>
<body>
@foreach($products as $product)
    <ul>
        <a href="{{route('product.buy', ['product' => $product->id])}}"> Buy Now  <li>{{$product->name}}</li></a>
    </ul>
@endforeach
</body>
</html>
