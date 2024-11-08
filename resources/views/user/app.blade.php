<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Favicons -->
       <!-- Favicons -->
       <link href="{{ asset('assets/layouts/welcome/img/favicon.png') }}" rel="icon">
       <link href="{{ asset('assets/layouts/welcome/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
      

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/layouts/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/layouts/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/layouts/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
      
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/layouts/css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        @inertia
    
        <!-- Vendor JS Files -->
   
        <script src="{{ asset('assets/layouts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Template Main JS File -->
        <script src="{{ asset('assets/layouts/js/main.js')}}"></script>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </body>
</html>
