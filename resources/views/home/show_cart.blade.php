<!DOCTYPE html>
<html>
   <head>
    <!-- sweet alert cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
           <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">
        .body{
            min-height: 80vh;
        }
        .title{
            text-align: center;
            font-size: 35px;
            font-weight: 500;
        }

        .item{
            font-size: 23px;
        }

        .head{
            font-size: 25px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
            <div class="container p-5 body">
                @if(session()->has('del_message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('del_message') }}
                </div>
                @endif
                @if(session()->has('order_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('order_message') }}
                </div>
                @endif
            <h2 class="title m-4">Cart</h2>
            <table class="table text-center">
                <thead>
                    <tr>
                    <th class="head" scope="col">Product title</th>
                    <th class="head" scope="col">Price</th>
                    <th class="head" scope="col">Quantity</th>
                    <th class="head" scope="col">Image</th>
                    <th class="head" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_price = 0 ?>
                    @foreach($carts as $item)
                    <tr>
                        <td class="item">{{ $item->product_title }}</td>
                        <td class="item">${{ $item->price }}</td>
                        <td class="item">{{ $item->quantity }}</td>
                        <td class="item"><img class="m-auto" width="150px" height="150px" src="/products/{{ $item->image }}" /></td>
                        <td class="item"><a href="{{url('del_cart', $item->id)}}" onclick="confirmation(event)" class="btn btn-danger">Remove from cart</a></td>
                        <?php $total_price = $total_price + $item->price ?>
                </tr>
                @endforeach
                </tbody>
            </table>
            <h2 class="title">Total Price : <span class="text-danger">${{ $total_price }}</span></h2>
            <div class="order rounded bg-gray-50 pb-4 pt-4 m-4">
                <h2 class="title mb-3 text-black-50">Proceed To Order</h2>
                <div class="text-center">
                    <a href="{{ url('order_cash') }}" class="btn btn-success mx-2">Cash on delivery</a>
                <a href="{{ url('stripe' , $total_price) }}" class="btn btn-primary mx-2">Pay using card</a>
                </div>
            </div>
        </div>

        <!-- footer start -->
        @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>

      <!-- confirmation -->
<script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are you sure you want to remove this product from the cart?",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }
        });
    }
</script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
