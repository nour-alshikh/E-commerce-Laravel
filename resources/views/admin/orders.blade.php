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
        width: 250px;
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
                <h2 class="title text-center">All Orders</h2>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif

                <div>
                    <form method="GET" action="{{ url('search') }}" class="d-flex flex-column justify-content-center align-items-center my-4">
                        @csrf
                        <input type="text" name="search" placeholder="Type Here" class="form-control my-3" style="width:600px; color: black;"/>
                        <input type="submit" value="search" class="btn btn-outline-primary" />
                    </form>
                </div>

                <table class="tabl border text-center my-4">
                    <tr>
                        <td class=" font-weight-bold head p-3 border">Name</td>
                        <td class=" font-weight-bold head p-3 border">Email</td>
                        <td class=" font-weight-bold head p-3 border">Address</td>
                        <td class=" font-weight-bold head p-3 border">Phone</td>
                        <td class=" font-weight-bold head p-3 border">Product</td>
                        <td class=" font-weight-bold head p-3 border">Quantity</td>
                        <td class=" font-weight-bold head p-3 border">Price</td>
                        <td class=" font-weight-bold head p-3 border">Payment status</td>
                        <td class=" font-weight-bold head p-3 border">Delivery status</td>
                        <td class=" font-weight-bold head p-3 border">Image</td>
                        <td class=" font-weight-bold head p-3 border">Delivery</td>
                        <td class=" font-weight-bold head p-3 border">Print</td>
                        <td class=" font-weight-bold head p-3 border">Send Email</td>

                    </tr>
                    @forelse($orders as $order)
                    <tr>
                        <td  class=" p-3 border">{{ $order->name }}</td>
                        <td  class=" p-3 border">{{ $order->email }}</td>
                        <td  class=" p-3 border">{{ $order->address }}</td>
                        <td  class=" p-3 border">{{ $order->phone }}</td>
                        <td  class=" p-3 border">{{ $order->product_title }}</td>
                        <td  class=" p-3 border">{{ $order->quantity }}</td>
                        <td  class=" p-3 border">{{ $order->price }}</td>
                        <td  class=" p-3 border">{{ $order->payment_status }}</td>
                        <td  class=" p-3 border">{{ $order->delivery_status }}</td>
                        <td  class=" p-3 border">
                            <img class="size" src="/products/{{ $order->image }}" />
                        </td>
                        @if($order->delivery_status == 'Proccessing')
                        <td  class=" p-3 border">
                            <a href="{{ url('deliver',$order->id) }}" class="btn btn-success" onclick="confirmation(event)">Delivered</a>
                        </td>
                        @else
                        <td  class=" p-3 border">
                            <p style=" color: green; font-size: 16px; font-weight: 600;">Delivered</p>
                        </td>
                        @endif
                        <td  class=" p-3 border">
                            <a href="{{ url('print_order',$order->id) }}" class="btn btn-warning" >Print</a>
                        </td>
                        <td  class=" p-3 border">
                            <a href="{{ url('send_email',$order->id) }}" class="btn btn-info" >Send Email</a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="16">
                            <p class="text-center text-danger py-4">No Data Found</p>
                        </td>
                    </tr>

                    @endforelse

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
            title: "Are you sure this order is delivered?",
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
