@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{-- <strong>Success!</strong> --}}
    {{ Session::get('success') }}
</div>
@endif
