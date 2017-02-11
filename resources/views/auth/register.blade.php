@extends('layouts.logReg')

@section('content')
<div class="container" ng-controller="signUpCtrl">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <div class="col-md-6 col-md-offset-3">
           <h1 style="text-align: center">
              <a href="{{url('/')}}">  Acada <small style="color:#1ab394">Sign Up</small></a>
           </h1>
            <div class="ibox-content">
                <form class="m-t" name ="signUpForm" ng-submit ="signUpForm.$valid && create(signUpForm.$valid)" novalidate>
                {!! csrf_field() !!}

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} " ng-class="{'has-error':signUpForm.$submitted && signUpForm.name.$invalid || signUpForm.name.$touched && signUpForm.name.$invalid || errors.name}">
                        <input type="name" ng-model="signUp.name" class="form-control input-lg" name = "name" placeholder="Your Name" required="">
                        <div class="help-block m-b-none" ng-show="signUpForm.$submitted && signUpForm.name.$invalid || signUpForm.name.$touched">
                            <span ng-show = "signUpForm.name.$error.required">This field is required</span>
                             <span ng-show = "signUpForm.name.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none has-error" ng-show="errors.name">
                                 <span ng-show = "errors.name">@{{ errors.name.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} " ng-class="{'has-error': signUpForm.$submitted && signUpForm.email.$invalid || signUpForm.email.$touched && signUpForm.email.$invalid || errors.email}">
                        <input type="email" ng-model="signUp.email" class="form-control input-lg" name = "email" placeholder="Email Address" required="">

                        <div class="help-block m-b-none" ng-show="signUpForm.$submitted && signUpForm.email.$invalid || signUpForm.email.$touched">
                            <span ng-show = "signUpForm.email.$error.required">This field is required</span>
                             <span ng-show = "signUpForm.email.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none has-error" ng-show="errors.email">
                                 <span ng-show = "errors.email">@{{ errors.email.toString() }}</span>
                            </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} " ng-class="{'has-error':signUpForm.$submitted && signUpForm.password.$invalid || signUpForm.password.$touched && signUpForm.password.$invalid || errors.password}">
                        <input type="password" ng-model="signUp.password" class="form-control input-lg" name = "password" placeholder="Password" required="">
                        <div class="help-block m-b-none" ng-show="signUpForm.$submitted && signUpForm.password.$invalid || signUpForm.password.$touched">
                            <span ng-show = "signUpForm.password.$error.required">This field is required</span>
                             <span ng-show = "signUpForm.password.$error.email">Please enter a valid email address</span>
                        </div>
                        <div class="help-block m-b-none has-error" ng-show="errors.password">
                                 <span ng-show = "errors.password">@{{ errors.password.toString() }}</span>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" ladda="isProcessing" data-style="expand-right">Sign Up</button>

                    <p>
                        <a class="btn btn-sm btn-white btn-block" href="{{url('/auth/twitter')}}">Sign Up with Twitter</a>
                        <a class="btn btn-sm btn-white btn-block" href="{{url('/auth/facebook')}}">Sign Up with Facebook</a>
                    </p>


                    <p class="text-muted text-center">
                        <small>I already own an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{url('/login')}}">Sign In</a>
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
