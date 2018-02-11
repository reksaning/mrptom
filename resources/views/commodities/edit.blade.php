@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-sm-6">
	
	<h1>Edit Data Komoditas</h1>
	<hr>

	<form method="POST" action="/commodity/{{$commodity->id}}">
		{{csrf_field()}}
		{{ method_field('PUT') }}

	
		<div class="form-group">
			<label for="title">Nama Komoditas</label>
			<input value="{{$commodity->name}}" type="text" class="form-control" id="name" name="name">
		</div>

		<div class="form-group">
			<label for="title">Lama Tanam (bulan)</label>
			<input value="{{ $commodity->time }}" type="integer" class="form-control" id="time" name="time">
		</div>

			<hr>
		<div class="row">	
			<div class="form-group">
				<button type="submit" class="btn btn-secondary">Selesai</button>
			</div>
		</div>
	</div>
	

	
		


	</form>
	
</div>

@include('layouts.errors')

@endsection	