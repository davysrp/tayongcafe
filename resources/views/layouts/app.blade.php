<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tanyong Cafe</title>

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
<body class="d-flex flex-column">
{{--<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{!! route('homePage') !!}">ខេ អេជ អឹម អឹម អូ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {!! Form::open(['route'=>'productList','class'=>'d-flex','method'=>'get']) !!}
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-search" type="submit"><i class="fas fa-search"></i> Search</button>
            {!! Form::close() !!}

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if(!Auth::guard('seller')->user())
                    <li class="nav-item active">
                        <a class="nav-link btn nav-btn-login" href="{!! route('memberFormLogin') !!}"><i
                                class="fa-solid fa-arrow-right-to-bracket"></i> Sign In <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn nav-btn-register" href="{!! route('memberFormRegister') !!}"><i
                                class="fas fa-user-tie"></i> Sign Up</a>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-cart position-relative" href="{!! route('cartList') !!}"><i
                                class="fas fa-cart-plus"></i> កន្ត្រក
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                @if(Session::get('cart'))
                                    {!!  count(session('cart')) !!}
                                @else
                                    0
                                @endif
                                 <span class="visually-hidden">unread messages</span></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link btn nav-btn-login" href="{!! route('sellerprofile') !!}"><i
                                class="fas fa-user"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn nav-btn-register" href="{{ route('sellerlogout') }}"><i
                                class="fas fa-lock"></i> Sign Out</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>--}}
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <a class="navbar-brand" href="/">
                 <img src="logo.svg" alt="logo">
             </a>

             {{-- <a class="navbar-brand" href="/">
                <img src="/public/storage/logo.png" alt="logo">
            </a> --}}
            

            <a class="navbar-brand" href="{!! route('homePage') !!}">Tanyong Cafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    id="toggleMobileNav" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-mobile" id="navbarSupportedContent">
                {{-- {!! Form::open(['route'=>'productList','class'=>'d-flex','method'=>'get']) !!}
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-search" type="submit"><i class="fas fa-search"></i> Search</button>
                {!! Form::close() !!} --}}

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if(!Auth::guard('seller')->user())
                        <li class="nav-item active">
                            <a class="nav-link btn nav-btn-login" href="{!! route('memberFormLogin') !!}"><i
                                    class="fa-solid fa-arrow-right-to-bracket"></i> Sign In <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn nav-btn-register" href="{!! route('memberFormRegister') !!}"><i
                                    class="fas fa-user-tie"></i> Sign Up</a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-cart position-relative" href="{!! route('cartList') !!}"><i
                                    class="fas fa-cart-plus"></i> កន្ត្រក
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                @if(Session::get('cart'))
                                        {!!  count(session('cart')) !!}
                                    @else
                                        0
                                    @endif
                                 <span class="visually-hidden">unread messages</span></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link btn nav-btn-login" href="{!! route('sellerprofile') !!}"><i
                                    class="fas fa-user"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn nav-btn-register" href="{{ route('sellerlogout') }}"><i
                                    class="fas fa-lock"></i> Sign Out</a>
                        </li>

                    @endif
                </ul>
            </div>


        </div>
    </nav>
    <?php

    $category = \App\Models\Category::whereStatus(1)->get();
    ?>

    {{ $slot }}

    {{-- <div class="mt-auto">
        <div class="footer-container">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-6 text-center">
                        <a href="{{route('page',['page'=>3,'about'=>'Privacy'])}}">Privacy</a>
                        <a href="{{route('page',['page'=>2,'about'=>'Term & Condition'])}}">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <footer class="footer py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <p>Copyright ©2025 តាន់យ៉ុងកាហ្វេ - Tanyong Café. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
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
