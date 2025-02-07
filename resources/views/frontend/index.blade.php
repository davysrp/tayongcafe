<x-app-layout>
    <div class="wrap-home">
        <div class="container">
            {{-- <div class="row">
                <div class="col text-center">
                    <img src="{{ url('photo/logo.png') }}" alt="Tanyong Cafe Logo">
                </div>
            </div> --}}
            {{-- <div class="wrap-title">
                <div class="row">
                    <div class="col text-center">
                        <h1 class="company-title">Tanyong Cafe</h1>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="login-block text-center">
                @if(Auth::guard('seller')->check())
                    <a href="{!! route('sellerprofile') !!}" class="btn btn-login">
                        <i class="fa-solid fa-user"></i> Profile
                    </a>
                    <a class="btn btn-logout" href="{{ route('sellerlogout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-sign-out-alt"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('sellerlogout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{!! route('memberFormLogin') !!}" class="btn btn-login">
                        <i class="fa-solid fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{!! route('memberFormRegister') !!}" class="btn btn-register">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                @endif
            </div> --}}
        </div>
    </div>
    
    @include('frontend.productList')
</x-app-layout>
