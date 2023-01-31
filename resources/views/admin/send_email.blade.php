<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin/head')
   <style type="text/css">
    .title{
        font-size: 40px;
        margin: 20px;
    }

    .form{
        display:flex;
        flex-direction: column;
    }

    .name{
        border-radius: 3px;
        border: none;
        outline: none;
        color: black;
    }

    .button{
        padding: 10px;
        margin: 40px auto;
        width:400px;
    }

    .tabl{
        width: 70%;
        margin: auto;
    }

    .border{
        padding: 30px;
    }

        .head{
        background-color: skyblue;
        font-size: 20px;
    }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
   @include('admin/sidebar')
   <!-- partial -->
   <div class="container-fluid page-body-wrapper">
       <!-- partial:partials/_navbar.html -->
       @include('admin/navbar')
       <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper text-center">
               <h1 class="text-center my-5" style="font-size: 22px;">Send Email to <span class="text-success">{{ $order->email }}</span></h1>
               <form action="{{ url('send_user_email' , $order->id) }}" method="POST" class="d-flex justify-content-center align-items-center flex-column">
                @csrf
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email Greeting</label>
                    <input style="color: black;" name="greeting" type="text" />
                </div>
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email First line</label>
                    <input style="color: black;" name="first_line" type="text" />
                </div>
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email Body</label>
                    <input style="color: black;" name="body" type="text" />
                </div>
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email Button name</label>
                    <input style="color: black;" name="button" type="text" />
                </div>
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email URL</label>
                    <input style="color: black;" name="url" type="text" />
                </div>
                <div class=" my-3 w-25 d-flex justify-content-between">
                    <label>Email Last line</label>
                    <input style="color: black;" name="last_line" type="text" />
                </div>
                <div class="my-3">
                    <input type="submit" class="btn btn-primary" value="Send Email" />
                </div>
               </form>
            </div>
        </div>
       <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin/script')

  </body>
</html>
