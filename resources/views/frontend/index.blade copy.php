<x-app-layout>
    
    <div class="wrap-home">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <img src="{{ url('photo/logo.png')}}" alt="">
                </div>
            </div>
            <div class="wrap-title">
                <div class="row">
                    <div class="col text-center">
                        <h1 class="company-title">Tanyong Cafe</h1>
                    </div>
                </div>
            </div>
            <div class="login-block">
                @if(Auth::guard('seller')->user())
                    <a href="{!! route('sellerprofile') !!}" class="btn btn-login"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i> Profile</a>

                    <a class="btn btn-login" href="{{ route('sellerlogout') }}">Log Out</a>
                @else
                    <a href="{!! route('memberFormLogin') !!}" class="btn btn-login"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                    <a href="{!! route('memberFormRegister') !!}" class="btn btn-register"><i
                            class="fa-solid fa-user-plus"></i> Register</a>
                @endif


            </div>
        </div>
    </div>
    
    @include('frontend.productList')

</x-app-layout>
