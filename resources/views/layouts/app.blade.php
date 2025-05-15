<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Tanyong Cafe') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koh+Santepheap:wght@100;300;400;700;900&display=swap" rel="stylesheet">

{{--    <!-- Styles -->--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.min.css') }}">--}}



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Cart Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href="{!! asset('assets/khqr/style.css?v='.time()) !!}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">


    @isset($css)
        {!! $css !!}
    @endisset
</head>
<body class="d-flex flex-column">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('homePage') }}">
                    <img src="{{ asset('Logo.svg') }}" alt="Tanyong Cafe Logo" width="150" height="50">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" id="toggleMobileNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse navbar-mobile" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @guest('customer')
                            <li class="nav-item active">
                                <a class="nav-link btn nav-btn-login" href="{{ route('memberFormLogin') }}">
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i> {{ __('Sign In') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn nav-btn-register" href="{{ route('memberFormRegister') }}">
                                    <i class="fas fa-user-tie"></i> {{ __('Sign Up') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-cart position-relative" href="{{ route('cart.index') }}">
                                    <i class="fas fa-cart-plus"></i> {{ __('Cart') }}
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ session('cart') ? count(session('cart')) : 0 }}
                                    </span>
                                </a>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{ $slot }}

        <footer class="footer py-4">
            <div class="container text-center">
                <p>&copy;2025 {{ __('Tanyong Café') }}. {{ __('All Rights Reserved') }}</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @if(isset($script))
    {!! $script !!}
@endif
    <script>
        $(document).ready(function () {
            @if(session('success'))
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: '{{ session('success') }}',
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: '{{ session('error') }}',
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            @endif

        });


        // $(document).ready(function () {
        //     $('body').delegate('.btn-plus','click',function(){
        //         var id=$(this).data('id')
        //         var qty=$('#quantity-'+id).val();
        //         if (button.dataset.type === 'plus' && qty < 99) {
        //             qty=qty+1
        //             // qty++;
        //         }

        //         $('#quantity-'+id).val(qty);
        //     })
        // })
    </script>
</body>
</html>
