@extends("layouts.master")

@section('content')

<div class="container"> 
<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a href="home">Home</a></li>
		  <li class="active">Login</li>
		</ol>
	</div>
			<div class="row">
				<h3 class="col-sm-11 text-danger text-center">{{$str}}</h3>
			</div>
			<br>
			<?php if(\Session::has('id')==false){ ?>

			<div class="row">
	
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						{!! Form::open(['url'=>"login", 'method'=>'PATCH'])!!}
							<input type="email" name="email" placeholder="Email Address" required/>
							<input type="password" name="password" placeholder="password" required/>
							<button type="submit" class="btn btn-default">Login</button>
						{!!Form::close()!!}
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						{!! Form::open(['url'=>"signup", 'method'=>'PATCH'])!!}
							<input type="text" name="nama" placeholder="Name" required/>
							<input type="email" name="email" placeholder="Email Address" required/>
							<input type="password" name="password" placeholder="Password" required/>
							<button type="submit" class="btn btn-default">Signup</button>
						{!!Form::close()!!}
					</div><!--/sign up form-->
				</div>
			</div>
			<?php } ?>
	<br>
	<br>
	<br>
	
@stop