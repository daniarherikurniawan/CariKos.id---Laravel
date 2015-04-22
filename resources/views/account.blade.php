@extends("layouts.master")

@section('content')
<br><br><br><br><br>
	<div class="contact-form">
			<div class="container">
				<div class="col-md-3 contact2"></div>
				<div class="col-md-6 contact2">
					<h3 class="text-center">Edit Akun</h3>
						{!! Form::open(['class'=>'text-right','url'=>"checkupdate", 'method'=>'PATCH'])!!}
						<input type="text" class="text" name='nama' value="{{$user->nama}}"  onblur="if (this.value == '') {this.value = '{{$user->nama}}';}" required >
						<input type="email" class="text" name='email' value="{{$user->email}}"  onblur="if (this.value == '') {this.value = '{{$user->email}}';}" required >
						<input type="password" class="text" name='password' value="{{$user->password}}"  onblur="if (this.value == '') {this.value = '{{$user->password}}';}"  required>
						<input 	type="submit" value="Save">
						<div><a href=""></a></div>
						{!!Form::close()!!}
				</div>
				<div class="col-md-3 contact2"></div>
				<div class="clearfix"></div>
			</div>
		</div>
	<br>
	
@stop