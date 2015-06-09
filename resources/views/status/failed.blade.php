<?php 
	 header("Refresh: 1 ; url=$url");
 ?>
@extends("layouts.master")
@section('content')
	<br><br><br><br><br><br><br><br>
	<div class="row">
		<div class = "text-center">
			<img width="50" class="" src="{{asset('images/status/failed.png')}}">
		</div>
	</div>
	<br>
	<div class=" text-center text-info" ><h4><p>{{$str}}</p></h4></div>
	<br><br><br><br><br><br><br><br>
@stop