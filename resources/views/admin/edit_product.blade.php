<!DOCTYPE html>
<html lang="en">
  <head>
    include('admin/head')

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
                <h2 class="title">Update Product</h2>
                <form method="POST" action="{{url('/update_product' , $product->id)}}" enctype="multipart/form-data" class=" w-50 m-auto">
                @csrf
                <div class="form">
                    <label>Title :</label>
                    <input required type="text" class="width name" name="title" value="{{ $product->title }}">
                </div>
                <div class="form">
                    <label>Description :</label>
                    <input required type="text" class="width name" name="desc" value="{{ $product->desc }}">
                </div>
                <div class="form">
                    <label>Price :</label>
                    <input required type="number" class="width name" name="price" value="{{ $product->price }}">
                </div>
                <div class="form">
                    <label>Discount Price :</label>
                    <input type="number" class="width name" min="0" name="discount_price" value="{{ $product->discount_price }}">
                </div>
                <div class="form">
                    <label>Quantity :</label>
                    <input required type="number" class="width name" min="0" name="quantity"  value="{{ $product->quantity }}">
                </div>
                <div class="form">
                    <label>Category :</label>
                    <select required name="cat" class="black width" >
                        <option value="{{ $product->cat }}">{{ $product->cat }}</option>
                        @foreach($cats as $cat)
                        <option value="{{ $cat->cat_name }}">{{ $cat->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form">
                    <label>Current Image :</label>
                    <img width="150px" height="150px" src="/products/{{ $product->image }}" />
                </div>
                <div class="form">
                    <label>New Image :</label>
                    <input type="file" class="width name" name="image">
                </div>
                <div class="form">
                    <input required type="submit" class="btn btn-primary button" name="submit" value="Update Product">
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
