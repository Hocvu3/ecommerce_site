<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap-social/bootstrap-social.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/toastr.min.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    @yield('content')
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('admin/assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/popper.js')}}"></script>
  <script src="{{asset('admin/assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/stisla.js')}}"></script>
  <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{asset('admin/assets/js/scripts.js')}}"></script>
  <script src="{{asset('admin/assets/js/custom.js')}}"></script>
  <script>
    toastr.options.progressBar = true;
    toastr.options.closeButton = true;
    toastr.options.closeDuration = 300;

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>
</body>
</html>
