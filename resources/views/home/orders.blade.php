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
                @if(session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
            <h2 class="title m-4">Orders</h2>
            <table class="table text-center">
                <thead>
                    <tr>
                    <th class="head" scope="col">Product title</th>
                    <th class="head" scope="col">Price</th>
                    <th class="head" scope="col">Quantity</th>
                    <th class="head" scope="col">Payment status</th>
                    <th class="head" scope="col">delivery status</th>
                    <th class="head" scope="col">Image</th>
                    <th class="head" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="item">{{ $order->product_title }}</td>
                        <td class="item">${{ $order->price }}</td>
                        <td class="item">{{ $order->quantity }}</td>
                        <td class="item">{{ $order->payment_status }}</td>
                        <td class="item">{{ $order->delivery_status }}</td>
                        <td class="item"><img class="m-auto" width="150px" height="150px" src="/products/{{ $order->image }}" /></td>
                        @if($order->delivery_status == 'Proccessing')
                        <td class="item"><a href="{{url('del_order', $order->id)}}" onclick="confirmation(event)" class="btn btn-danger">Delete order</a></td>
                        @else
                        <td><p style="font-size: 18px;" class="text-success">this order is delivered or deleted</p></td>
                        @endif
                </tr>
                @endforeach
                </tbody>
            </table>
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
            title: "Are you sure you want to delete this order?",
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
