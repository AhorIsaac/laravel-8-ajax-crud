<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta-tag')
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/all.css') }}" type="text/css" rel="stylesheet">
    @yield('csslinktags')
    @yield('headscripts')
    <title> @yield('title') </title>
    @yield('style')
</head>
<body>            
    @yield('content')

    @yield('startscripts')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"> </script>
    <script src="{{ asset('assets/bootstrap/js/all.min.js') }}"> </script>    
    @yield('endscripts')  
</body>
</html>