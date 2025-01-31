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
                                    <h4>Reset Password</h4>

                                    {!! Form::open(['route'=>'saveChangePassword','method'=>'post']) !!}
                                    <div class="form-group">
                                        {!! Form::label('email','Email*') !!}
                                        {!! Form::text('email',$password->email,['class'=>'form-control','readonly','placeholder'=>'Enter your email']) !!}
                                        @error('email')
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
                                        {!! Form::label('confirm_password','Confirm Password*') !!}
                                        {!! Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Enter confirm password']) !!}
                                        @error('confirm_password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-signin w-100"><i
                                                class="fa-solid fa-arrow-right-to-bracket"></i> Update Password
                                        </button>
                                    </div>

                                    {!! Form::close() !!}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
