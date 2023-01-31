<!DOCTYPE html>
<html lang="en">
     <!-- sweet alert cdn -->
     <head>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                <h2 class="title">Add Testimonial</h2>
                <form method="POST" action="{{url('/store_testim')}}" class="form" enctype="multipart/form-data">

                @csrf

                    <input type="text" class="w-75 mx-auto name my-3" name="name" placeholder="Enter new Name">
                    <input type="file" class=" mx-auto name my-3" name="image" >
                    <input type="text" class="w-75 mx-auto name my-3" name="testim" placeholder="Enter new Testimonial">
                    <input type="submit" class="btn btn-primary button" name="submit" value="Add Testimonial">
                </form>
                <table class="tabl border">
                    <tr>
                        <td class=" p-3 border head">Customer Name</td>
                        <td class=" p-3 border head">Customer image</td>
                        <td class=" p-3 border head">Testimonial</td>
                        <td  class=" p-3 border head">Action</td>
                    </tr>
                    @foreach($testims as $testim)
                    <tr>
                        <td class=" p-3 border">{{ $testim->name }}</td>
                        <td class=" p-3 border">
                            <img src="products/{{ $testim->image }}" style="margin: auto;" width="150px" height="150px" alt="no img" />
                        </td>
                        <td class=" p-3 border">{{ $testim->testimonial }}</td>
                        <td  class=" p-3 border">
                            <a href="{{ url('del_testim' , $testim->id) }}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
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
            title: "Are you sure you want to delete this testimonial?",
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
