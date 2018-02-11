@extends('layouts.master')

@section('content')
	<h1>Edit BOM</h1>
	<hr>

	<form method="POST" action="/bom/{{$bom->id}}">
		{{csrf_field()}}
		{{ method_field('PUT') }}

	<div class="col-sm-6">
		
		<div class="form-group">
			<label for="commodity_id">Komoditas</label>
				<select class="form-control" id="commodity_id" name="commodity_id">

				@foreach ($commodities as $commodity)
					<option value="{{$commodity->id}}">{{$commodity->name}}</option>
				@endforeach

				</select> 
		</div>
		

		<div class="form-group">
			<label for="central_id">Outlet</label>
				<select class="form-control" id="central_id" name="central_id">

				@foreach ($outlets as $outlet)
					<option value="{{$outlet->id}}">{{$outlet->name}}</option>
				@endforeach

				</select> 
		</div>

		<div class="form-group">
			<label for="title">Bahan Kemas</label>
			<select class="form-control" id="packaging_id" name="packaging_id">
				@foreach ($packagings as $packaging)
					<option value="{{ $packaging->id }}">{{$packaging->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="body">Jumlah (pcs) </label>
			<input type="integer" value="{{ $bom->quantity }}" class="form-control" id="quantity" name="quantity">
		</div>
			<hr>
	
			<div class="form-group">
				<button type="submit" class="btn btn-secondary">Selesai</button>
			</div>

	</div>
	

	
		


	</form>
	@include('layouts.errors')



@endsection	