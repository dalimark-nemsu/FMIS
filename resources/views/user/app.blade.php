<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title inertia>{{ config("app.name", "Laravel") }}</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/layouts/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs5.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/layouts/css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    @inertia

    <!-- jQuery (required for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <!-- Initialize Summernote (optional improvements) -->
    <script>
      $(document).ready(function () {
        $('#editor').summernote({
          height: 300,
          callbacks: {
            onInit: function () {
              // Reinitialize Bootstrap tooltips if necessary
              document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el);
              });
            }
          }
        });
      });
    </script>

    @routes
    @vite(["resources/js/app.js", "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
  </body>
</html>
