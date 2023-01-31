<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin/head')

      <style type="text/css">
    .title{
        font-size: 40px;
        margin: 70px;
        text-align: center;
    }

    .form{
        display:flex;
        margin: 20px;
        justify-content: space-between;
    }

    .name{
        border-radius: 3px;
        border: none;
        outline: none;
        color: black;
    }

    label{
        font-size: 20px;
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

    .black{
        color: black;
    }
    .width{
        min-width: 350px;
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
            <div class="content-wrapper">
                 @if(session()->has('create_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('create_message') }}
                </div>
                @endif
                <h2 class="title">Add Product</h2>
                <form method="POST" action="{{url('/add_product')}}" enctype="multipart/form-data" class=" w-50 m-auto">

                @csrf
                <div class="form">
                    <label>Title :</label>
                    <input required type="text" class="width name" name="title">
                </div>
                <div class="form">
                    <label>Description :</label>
                    <input required type="text" class="width name" name="desc">
                </div>
                <div class="form">
                    <label>Price :</label>
                    <input required type="number" class="width name" name="price">
                </div>
                <div class="form">
                    <label>Discount Price :</label>
                    <input type="number" class="width name" min="0" name="discount_price">
                </div>
                <div class="form">
                    <label>Quantity :</label>
                    <input required type="number" class="width name" min="0" name="quantity">
                </div>
                <div class="form">
                    <label>Category :</label>
                    <select required name="cat" class="black width" >
                        <option value="" selected>Add category here</option>
                        @foreach($cats as $cat)
                        <option value="{{ $cat->cat_name }}">{{ $cat->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form">
                    <label>Image :</label>
                    <input required type="file" class="width name" name="image">
                </div>
                <div class="form">
                    <input required type="submit" class="btn btn-primary button" name="submit" value="Add Product">
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
