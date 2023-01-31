<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin/head')
       <!-- sweet alert cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
              @foreach($users as $user)
                <div class="d-flex justify-content-between align-items-center p-3 mx-auto my-5 w-50" style="background-color: #cfe2ff; border-color: #b6d4fe;color: #084298;border-radius: 8px;">
                    @if( $user->usertype != "1")
                    <h2 style="font-weight: 400;">{{ $user->name }}</h2>
                    <a href="{{ url('add_admin' , $user->id) }}" class="btn btn-primary" onclick='confirmation(event)'>Make Admin</a>
                    @else
                    <h2 style="font-weight: 700; font-size: 20px;">{{ $user->name }}</h2>
                    <div>
                <a href="{{ url('remove_admin' , $user->id) }}" class="btn btn-danger" onclick='remoconfirmation(event)'>Remove Admin</a>
                </div>
                @endif
                </div>
              @endforeach
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
            title: "Are you sure you want to make this user admin ?",
            text: "You will not be able to revert this!",
            icon: "info",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }
        });
    }
      function remoconfirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title: "Are you sure you want to remove this user as an admin ?",
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
