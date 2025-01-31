<x-app-layout>

    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="wrap-login-form ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrap-bg-register" style="background: url({!! asset('photo/log-login.png') !!})"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="login-form">
                                    <h4>Sign Up</h4>
                                    {!! Form::open(['route'=>'memberRegister']) !!}
                                    <div class="form-group">
                                        {!! Form::label('full_name','Full Name*') !!}
                                        {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Enter your Full Name']) !!}
                                        @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('username','Username*') !!}
                                        {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Enter your username']) !!}
                                        @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('email','Email*') !!}
                                        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter your email']) !!}
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
                                        {!! Form::label('password','Confirm Password*') !!}
                                        {!! Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Enter your password']) !!}
                                        @error('confirm_password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-signin w-100"><i
                                                class="fa-solid fa-arrow-right-to-bracket"></i> Sign Up
                                        </button>
                                    </div>



                                    {!! Form::close() !!}
                                    <div class="row">
                                        <div class="col">
                                            <a href="{!! route('auth/google') !!}" class=" btn btn-signin w-100" ><i class="fab fa-google"></i> Google Account</a>
                                        </div>
                                    </div>
                                    <div class="login-footer text-center">
                                        <p>Already a member? <a href="{!! route('memberFormLogin') !!}" class="siginin">Sign
                                                In</a></p>
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
