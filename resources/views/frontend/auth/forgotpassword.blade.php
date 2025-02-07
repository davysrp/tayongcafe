<x-app-layout>

    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="wrap-login-form ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrap-bg" style="background: url({!! asset('photo/bg-1.jpg.webp') !!})"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="login-form">
                                    <h4>Forgot your password?</h4>
                                    <p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

                                    {!! Form::open(['route'=>'forgotPasswordSendLink','method'=>'POST']) !!}
                                    <div class="form-group">
                                        {!! Form::label('email','Email*') !!}
                                        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter your email address']) !!}
                                        @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-signin w-100"><i
                                                class="fa-solid fa-arrow-right-to-bracket"></i> Email Password Reset Link
                                        </button>
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
