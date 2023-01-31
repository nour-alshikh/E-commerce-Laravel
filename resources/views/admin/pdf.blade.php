<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Order Details</h1>
    <span>User Name :</span><h4>{{ $order->name }}</h4>
    <span>User Email :</span><h4>{{ $order->email }}</h4>
    <span>User Phone :</span><h4>{{ $order->phone }}</h4>
    <span>User Address :</span><h4>{{ $order->address }}</h4>
    <span>User Id :</span><h4>{{ $order->user_id }}</h4>

    <span>Product Id :</span><h4>{{ $order->product_id }}</h4>
    <span>Product Name :</span><h4>{{ $order->product_title }}</h4>
    <span>Product Price :</span><h4>{{ $order->price }}</h4>
    <span>Product Quantity :</span><h4>{{ $order->quantity }}</h4>
    <span>Payment Status :</span><h4>{{ $order->payment_status }}</h4>
    <span>Dilevery Status :</span><h4>{{ $order->delivery_status }}</h4>
    <span>Image :</span><br><br><img width="150px" height="150px" src="/products/{{$order->image}}" />
</body>
</html>
