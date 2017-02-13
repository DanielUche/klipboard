<!DOCTYPE html>
<html ng-app = "acada">
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title set in pageTitle directive -->
 
     {!! Html::style('public/css/bootstrap.min.css') !!}
    <!-- Fonts -->
    {!! Html::style('public/css/font-awesome/css/font-awesome.min.css') !!}
    <!-- Main CSS files -->
    {!! Html::style('public/css/animate.css') !!}
    
     {!! Html::style('public/css/toastr.min.css') !!}
     {!! Html::style('public/css/ladda-themeless.min.css') !!}
     {!! Html::style('public/css/style.css') !!}

    {!! Html::script('public/js/jquery-2.1.1.min.js') !!}
    {!! Html::script('public/js/jquery-ui/jquery-ui.js') !!}
    {!! Html::script('public/js/bootstrap.min.js') !!}

    
    <title>KlipBoard</title>

    <style type="text/css">
        .computed {
            display: none;
        }
        .computed2 {
            display: none;
        }
        .border-green{
            border:2px solid green;
        }
        .container {
            height: 100%;min-height: 100%;max-height: 100%;
            display: table;
        }
    </style>
</head>
<body class="gray-bg" landing-scrollspy id="page-top" style=" ">

<div id="wrapper" class="top-navigation" >
<div class="row border-bottom white-bg ng-scope">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="{{URL('index')}}" class="navbar-brand">KlipBoard</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar" ng-controller = "HomeCtrl">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL('upload-attandance') }}" >Upload Attendance</a></li> 

            </ul>
        </div>
    </nav>
</div>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <a href = "#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{Session::get('success') }}
    </div> 
    @elseif(Session::has('warning'))
    <div class="alert alert-warning alert-dismissable">
        <a href = "#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('warning') }}
    </div>
    @endif
    @yield('content')
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.computed').css({'display':'block'});
    });
</script>


</body>
</html>