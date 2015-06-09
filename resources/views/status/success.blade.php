<?php 
	 header("Refresh: 1 ; url=$url");
 ?>
@extends("layouts.master")
@section('content')
	<br><br><br><br><br><br><br><br>
	<div class="row">
		<div class = "text-center">
			<img width="50" class=" " src="{{asset('images/status/success.png')}}">
		</div>
	</div>
	<br>
	<div class="inline text-center text-success" ><h4>{{$str }}</h4></div>
	<br><br><br><br><br><br><br><br>
	</div>
@stop