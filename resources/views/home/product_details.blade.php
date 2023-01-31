<!DOCTYPE html>
<html>
   <head>
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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
                    <div class="box text-center my-5 w-75 mx-auto" style="display: flex; justify-content: space-between; align-items: center;">
                     <div class="img-box p-5">
                        <img style="width: 400px; height: 400px;" src="/products/{{ $product->image }}" alt="">
                     </div>
                     <div class="detail-box my-3">
                        <h5>
                           {{ $product->title }}
                        </h5>
                        <h6 class="my-3" style="font-size: 20px;">
                           Description : {{ $product->desc }}
                        </h6>
                        @if($product->discount_price != 0)
                        <h6 class="my-3" style="color: red; font-size: 20px;">
                           Price after discount : ${{ $product->discount_price }}
                        </h6>
                        <h6 class="my-3" style="text-decoration: line-through; opacity: 0.7; font-size: 20px;">
                           Price : ${{ $product->price }}
                        </h6>
                        @else
                        <h6 class="my-3" style="opacity: 0.7; font-size: 20px;">
                           Price : {{ $product->price }}
                        </h6>
                        @endif

                        <h6 class="my-3" style="font-size: 20px;">
                           Available Quantity{{ $product->quantity }}
                        </h6>
                        <h6 class="my-3" style="font-weight: 600; font-size: 20px;">
                           Category : {{ $product->cat }}
                        </h6>

                           <form method="POST" action="{{ url('add_cart' , $product->id) }}">
                            @csrf
                             <div class="row align-items-center">
                                <div class="col-md-4">
                                    <input type="number" style="width: 100px; margin: 0; " min="1" value="1" name="quantity" />
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Add to cart"/>
                                </div>
                            </div>
                        </form>

                     </div>
                  </div>

        <!-- footer start -->
        @include('home.footer')
    </div>

      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
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
