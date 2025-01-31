<x-app-layout>

    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="wrap-login-form ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrap-bg" style="background: url({!! asset('photo/log-login.png') !!})"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="login-form">
                                    <h4>Sign In</h4>
                                    <p>Please login to your account</p>

                                    {!! Form::open(['route'=>'memberLogin']) !!}
                                    <div class="form-group">
                                        {!! Form::label('username','Username*') !!}
                                        {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Enter your password']) !!}
                                        @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password','Password*') !!}
                                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter your password']) !!}
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-signin w-100"><i
                                                class="fa-solid fa-arrow-right-to-bracket"></i> Sign In
                                        </button>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <a href="{!! route('auth/google') !!}" class=" btn btn-signin w-100" ><i class="fab fa-google"></i> Google Account</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">

                                            <a href="{!! route('forgotPasswordForm') !!}" class="siginin">Forgot Password</a>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                    <div class="login-footer text-center">
                                        <p>Not a member? <a href="{!! route('memberFormRegister') !!}" class="siginin">Sign
                                                Up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
