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
                <h2 class="title">Update category</h2>
                <form method="POST" action="{{url('/update_cat' , $data->id)}}" class="form">

                @csrf

                    <input type="text" class="w-75 m-auto name" name="name" placeholder="Enter new category" value="{{ $data->cat_name }}">
                    <input type="submit" class="btn btn-primary button" name="submit" value="Update Category">
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
