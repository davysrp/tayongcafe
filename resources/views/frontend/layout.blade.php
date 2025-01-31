<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Delivery</title>

    <!-- Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset('frontend/bootstrap/css/bootstrap.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('frontend/fontawesome/css/all.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('frontend/css/style.css?v='.time()) !!}">
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koh+Santepheap:wght@100;300;400;700;900&display=swap"
          rel="stylesheet">
    <link href="{!! asset('frontend/summernote/summernote.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('frontend/summernote/summernote-bs4.min.css') !!}" rel="stylesheet">

    @if(isset($css))
        {!! $css !!}
    @endif
</head>
<body>
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="banner-container"> --}}

</div>


{{ $slot }}

<script src="{!! asset('frontend/jquery-3.7.1.min.js') !!}"></script>
<script src="{!! asset('frontend/bootstrap/js/bootstrap.bundle.min.js') !!}" type="text/javascript"></script>

<script src="{!! asset('frontend/jquery-ui/jquery-ui.min.js') !!}"></script>
<script src="{!! asset('frontend/jquery-validation/dist/jquery.validate.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('frontend/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('frontend/summernote/summernote-bs4.min.js') !!}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(isset($script))
    {!! $script !!}
@endif

<script>
    $(document).ready(function () {
        @if(session()->get('success'))
        Swal.fire({
            toast: true,
            icon: 'success',
            title: '{!! session()->get('success') !!}',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        @endif
        @if(session()->get('error'))
        Swal.fire({
            toast: true,
            icon: 'error',
            title: '{!! session()->get('error') !!}',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        @endif
    })

</script>
</body>
</html>
