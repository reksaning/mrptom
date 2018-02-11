@extends('layouts.master')

@section('content')
	<h1>Edit Data Bahan Kemas</h1>
	<hr>

	<form method="POST" action="/packaging/{{$packaging->id}}">
		{{csrf_field()}}
		{{ method_field('PUT') }}

	<div class="col-sm-6">
		<div class="form-group">
			<label for="title">Nama Bahan Kemas</label>
			<input value="{{$packaging->name}}" type="text" class="form-control" id="name" name="name">
		</div>

		<div class="form-group">
			<label for="title">Lama Pesan (hari)</label>
			<input value="{{ $packaging->time }}" type="integer" class="form-control" id="time" name="time">
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