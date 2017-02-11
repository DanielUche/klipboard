@extends('layouts.logReg')

@section('content')
<div class="container" ng-controller="signInCtrl">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <div class="col-md-6 col-md-offset-3">
           <h1 style="text-align: center">
              <a href="{{url('/')}}"> Sign In to Acada</a>
           </h1>
            <div class="ibox-content">

                <div class="alert alert-info" ng-show ="loginState==true">
                    Login success Redirecting......
                </div>

                 <form class="m-t" name ="signInForm" ng-submit ="signInForm.$valid && signIn(signInForm.$valid)" novalidate>
                {!! csrf_field() !!}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} " ng-class="{'has-error': signInForm.$submitted && signInForm.email.$invalid || signInForm.email.$touched && signInForm.email.$invalid}">


                        <input type="email" ng-model="signIn.email" class="form-control input-lg" name = "email" placeholder="Email Address" required="">

                        <div class="help-block m-b-none" ng-show="signInForm.$submitted && signInForm.email.$invalid || signInForm.email.$touched">
                            <span ng-show = "signInForm.email.$error.required">This field is required</span>
                             <span ng-show = "signInForm.email.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none" ng-show="errors.email">
                                 <span ng-show = "errors.email">@{{ errors.email.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} " ng-class="{'has-error':signInForm.$submitted && signInForm.password.$invalid || signInForm.password.$touched && signInForm.password.$invalid}">
                        <input type="password" ng-model="signIn.password" class="form-control input-lg" name = "password" placeholder="Password" required="">
                        <div class="help-block m-b-none" ng-show="signInForm.$submitted && signInForm.password.$invalid || signInForm.password.$touched">
                            <span ng-show = "signInForm.password.$error.required">This field is required</span>
                             <span ng-show = "signInForm.password.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none" ng-show="errors.password">
                                 <span ng-show = "errors.password">@{{ errors.password.toString() }}</span>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" ladda="isProcessing" data-style="expand-right">Login</button>

                    <p>
                        <a class="btn btn-sm btn-white btn-block" href="{{url('/auth/twitter')}}">Login with Twitter</a>
                        <a class="btn btn-sm btn-white btn-block" href="{{url('/auth/facebook')}}">Login with Facebook</a>
                    </p>

                    <a href="#">
                        <small>Forgot password?</small>
                    </a>

                    <p class="text-muted text-center">
                        <small>Do not have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{url('/register')}}">Create an account</a>
                </form>
                <p class="m-t">
                    <small>Acada video embed App. </small>
                </p>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
