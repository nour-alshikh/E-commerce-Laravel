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

        <!-- comment section -->
        <div class="comment my-5">
                <form action="{{ url('add_comment') }}" method="POST" class="text-center">
                    @csrf
                    <input name="comment" style="width: 400px;" placeholder="write comment here..."/>
                    <input type="submit" value="Add Comment"  />
                </form>
        </div>

            <div class="m-auto w-50">
                <h2 class="my-4 text-center" style="font-size: 28px; font-weight: 600;">All Comments</h2>
                @foreach($comments as $comment)
                <div style="background-color: rgba(0,0,0,0.05); border-radius: 6px;" class="m-5 p-3 ">
                <div>
                    <b style="font-size: 20px;">{{ $comment->name }}</b>
                    <p  style="font-size: 16px;" class="my-2">{{ $comment->comment }}</p>
                    <p class="text-muted" style="font-size: 14px;">{{ $comment->created_at }}</p>
                    <a href="javascript::void(0);" class="btn text-info" onclick="reply(this)" data-id="{{ $comment->id }}">Reply</a>
                </div>

                    @foreach($reply as $rep)
                        @if($rep->comment_id == $comment->id)
                        <div style="padding: 10px 40px; background-color: rgba(0,0,0,0.08); border-radius: 6px;" class="my-4 replyDiv">
                            <div>
                            <b>{{ $rep->name }}</b>
                            <p>{{ $rep->reply }}</p>
                            <p class="text-muted" style="font-size: 14px;">{{ $rep->created_at }}</p>
                            </div>
                            <a href="javascript::void(0);" class="btn text-info" onclick="reply(this)" data-id="{{ $comment->id }}">Reply</a>
                            </div>
                            <div>
                        </div>
                        @endif
                    @endforeach
                </div>
                    @endforeach

                <div class="reply" style="display: none; padding: 30px 100px;">
                    <form action="{{ url('add_reply') }}" method="POST">
                        @csrf
                        <input id="commentId" name="commentId" hidden />
                        <input name="reply" style="width: 400px; border: 1px solid gray; height: 35px;" placeholder="write comment here..."/>
                        <button type="submit" class="btn btn-warning">Reply</button>
                        <a href="javascript::void(0)" class="btn" onclick="reply_close(this)">Close</a>
                    </form>
                    </div>

            </div>

        <!-- end comment section -->

        <!-- footer start -->
        @include('home.footer')

      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
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
