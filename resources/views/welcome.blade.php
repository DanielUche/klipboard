@extends('layouts.index')
@section('content')
    <div class="container">
    <div class="row"> 
        <div class = "col-md-12" style="padding-top:30px">
            <a class="btn btn-lg btn-primary pull-right" href="{{url('/register')}}" role="button">Sign Up</a>
            <a class="btn btn-lg btn-default pull-right" style="margin-right: 5px" href="{{url('login')}}" role="button">Sign In</a>
        </div>
    </div>
        <div class ="col-md-8 col-md-offset-2"  style="text-align: center;margin-top: 130px">
            <h1 style="font-size:5em;">Acada</h1>
            <form action="{{url('/browse')}}" method="post">
            {!! csrf_field() !!}
                <input type="text" class="form-control input-lg" name="search" placeholder="Search Emdeds by Title or Category">
            </form>
        </div>
    </div>
@endsection