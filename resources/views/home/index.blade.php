@extends('layouts.app')
@section("content")

<div class="wrapper wrapper-content animated fadeInRight" >

<div class="col-md-10 col-md-offset-1 computed">
<div class="ibox float-e-margins"> 
 <div class="ibox-content">
 <div class="row"> 
	<form name="submitform" method="POST" action="{{ URL('index') }}">
	{{ csrf_field()}}
	<div class = "col-md-8 col-md-offset-2" >
	<div class = "col-md-8 ">

		<select value ="{{ old('year') }}" name ="year" class = "form-control">
			<option value="">Select One</option>
			<option value=2017>2017</option>
			<option value=2016>2016</option>
		</select>

	</div>
	<div class="col-md-3">
		<button type="submit" class="btn btn-md btn-info">Filter Result</button>
	</div>	
	</div>
	</form>
	</div>
</div>
</div>
</div>
<div class="col-md-10 col-md-offset-1 computed">
<div class="ibox float-e-margins">    
                <div class="ibox-content">

<table class ="table table-bordered">
	<tr>
		<th>SN</th>
		<th>Staff Name</th>
		<th>Month</th>
		<th>Total Attendance</th>
		<th>Days Late </th>
		<th>Days Early </th>
		<th>% lateness </th>
		<th>% Earliness</th>
	</tr>
	<?php $i=0; ?>
	@foreach($attendance as $a) 
	<?php $i++; ?>
	<tr>
	<td>
		{{$i}}
	</td>
	<td>
		 <a href = '{{ URL("staff/$a[id]") }}' >{{ $a['name'] }}</a>
		</td>
	<td>
		{{ $a['month'] }}
	</td>
		
		<td>
			{{  $a['total'] }}
		</td>			
		<td>
		 {{ $a['late'] }}
		</td>
		<td>
			{{ $a['early'] }}
		</td>
		<td>
			{{ $a['latepercent'] }}
		</td>
		<td>
			{{$a['earlypercent']}}
		</td>
	</tr>
	@endforeach
</table>
</div>
</div>
</div>
</div>

@endsection