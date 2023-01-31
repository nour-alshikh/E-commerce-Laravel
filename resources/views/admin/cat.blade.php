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
                @if(session()->has('create_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('create_message') }}
                </div>
                @endif
                @if(session()->has('del_message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('del_message') }}
                </div>
                @endif
                <h2 class="title">Add category</h2>
                <form method="POST" action="{{url('/add_cat')}}" class="form">

                @csrf

                    <input type="text" class="w-75 m-auto name" name="name" placeholder="Enter new category">
                    <input type="submit" class="btn btn-primary button" name="submit" value="Add Category">
                </form>
                <table class="tabl border">
                    <tr>
                        <td class=" p-3 border head">Category Name</td>
                        <td  class=" p-3 border head">Action</td>
                    </tr>
                    @foreach($data as $item)
                    <tr>
                        <td  class=" p-3 border">{{ $item->cat_name }}</td>
                        <td  class=" p-3 border">
                            <a href="{{ url('edit_cat' , $item->id) }}" class="btn btn-primary">Update</a>
                            <a onclick="confirmation(event)" href="{{ url('del_cat' , $item->id) }}" class="btn btn-danger">Delete</a>
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
            title: "Are you sure you want to delete this category?",
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
