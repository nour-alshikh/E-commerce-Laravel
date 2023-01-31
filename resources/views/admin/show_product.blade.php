<!DOCTYPE html>
<html lang="en">
  <head>
        <!-- sweet alert cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   @include('admin/head')
<style type="text/css">

    .title{
        font-size: 40px;
        margin: 20px;
    }
    .tabl{
        width: 70%;
        margin: auto;
    }

    .border{
        padding: 30px;
    }

    .size{
        width: 150px;
        height: 150px;
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
            <div class="content-wrapper">
                <h2 class="title text-center">All Products</h2>
                @if(session()->has('del_message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('del_message') }}
                </div>
                @endif
                @if(session()->has('update_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('update_message') }}
                </div>
                @endif
                <table class="tabl border text-center my-4">
                    <tr>
                        <td class=" font-weight-bold head p-3 border">Title</td>
                        <td class=" font-weight-bold head p-3 border">Description</td>
                        <td class=" font-weight-bold head p-3 border">Category</td>
                        <td class=" font-weight-bold head p-3 border">Quantity</td>
                        <td class=" font-weight-bold head p-3 border">Price</td>
                        <td class=" font-weight-bold head p-3 border">Discount price</td>
                        <td class=" font-weight-bold head p-3 border">Image</td>
                        <td class=" font-weight-bold head p-3 border">Delete</td>
                        <td class=" font-weight-bold head p-3 border">Edit</td>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td  class=" p-3 border">{{ $product->title }}</td>
                        <td  class=" p-3 border">{{ $product->desc }}</td>
                        <td  class=" p-3 border">{{ $product->cat }}</td>
                        <td  class=" p-3 border">{{ $product->quantity }}</td>
                        <td  class=" p-3 border">{{ $product->price }}</td>
                        <td  class=" p-3 border">{{ $product->discount_price }}</td>
                        <td  class=" p-3 border">
                            <img class="size" src="/products/{{ $product->image }}" />
                        </td>
                        <td  class=" p-3 border">
                            <a onclick="confirmation(event)" class="btn btn-danger" href="{{ url('/delete_product' , $product->id) }}">Delete</a>
                        </td>
                        <td  class=" p-3 border">
                            <a class="btn btn-primary" href="{{ url('/edit_product' , $product->id) }}">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin/script')

      <!-- confirmation -->
<script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are you sure you want to delete product?",
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
  </body>
</html>
