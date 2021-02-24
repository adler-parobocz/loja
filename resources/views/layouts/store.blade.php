
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Pricing example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('dist/js/jquery.min.js')}}"> </script>
    <link rel="stylesheet" href="{{asset('fontawesome-free/css/fontawesome.min.css')}}">
  </head>

  <body>
    @component('components.navbar')
    @endcomponent
    @hasSection('content')
        @yield('content')
    @endif
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
    
  </body>
</html>
