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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
            @foreach($tests as $test)
            <div class="item text-center" style="background-color: rgba(0,0,0,0.05); margin: 30px auto; padding: 20px; border-radius: 6px; min-width: 600px;">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner text-center">
                                 <img style="border-radius: 50%; width: 200px; height: 200px; margin: auto;" src="products/{{ $test->image }}" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5 style="font-size: 22px; font-weight: 700;">
                              {{ $test->name }}
                           </h5>
                           <h6 style="font-size: 18px; font-weight: 400;">
                              Customer
                           </h6>
                           <p>
                              {{ $test->testimonial }}
                           </p>
                        </div>
                     </div>
                  </div>
            @endforeach

        <!-- footer start -->
        @include('home.footer')

      <!-- footer end -->
             </div>
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
      <script type="text/javascript">
        function reply(caller){
            document.getElementById('commentId').value = $(caller).attr('data-Id')
            $('.reply').insertAfter($(caller))
            $('.reply').show()
        }

        function reply_close(caller){
            $('.reply').hide()
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
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
