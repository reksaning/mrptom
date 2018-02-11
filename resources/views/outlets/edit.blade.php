@extends('layouts.master')

@section('content')
	<h1>Edit Data Outlet</h1>
	<hr>

	<form method="POST" action="/supplier/{{$supplier->id}}">
		{{csrf_field()}}
		{{ method_field('PUT') }}

	<div class="col-sm-6">
		<div class="form-group">
			<label for="title">Nama Outlet</label>
			<input value="{{$supplier->name}}" type="text" class="form-control" id="name" name="name">
		</div>

		<div class="form-group">
			<label for="title">Inisial</label>
			<input value="{{ $supplier->initial }}" type="text" class="form-control" id="initial" name="initial">
		</div>

		<div class="form-group">
			<label for="body">Alamat </label>
			<input type="integer" value="{{ $supplier->address }}" class="form-control" id="address" name="address">
		</div>
			<hr>
		<div class="row">	
			<div class="form-group">
				<button type="submit" class="btn btn-secondary">Selesai</button>
			</div>
		</div>
	</div>
	

	
		


	</form>
	@include('layouts.errors')



@endsection	