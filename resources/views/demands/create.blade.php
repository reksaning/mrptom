@extends('layouts.master')
@section('content')




<h1>Input Data Permintaan Pasar</h1>
	<hr>

	<form method="POST" action="/demand">
		{{csrf_field()}}

	<div class="col-sm-6">
		<input type="hidden" name="outlet_id" value="{{ request('outlet_id') }}"><label></label>
		<input type="hidden" name="date" value="{{ request('date') }}">

	<div>
	<table class="table">
		<thead>
			<tr>
				<th> Komoditas </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($commodities as $commodity)
			<tr>
				<th>
					
					<input type="hidden" name="commodity_id[{{ $loop->index }}]" value="{{$commodity->id}}"><label>{{$commodity->name}} </label>
					<input type="integer" class="form-control" id="quantity" name="quantity[{{ $loop->index }}]" value="0">
				</th>
			</tr>		
			@endforeach

		</tbody>
	</table>

	<div class="row">	
			<div class="form-group">
				<button type="submit" class="btn btn-secondary">Kirim</button>
			</div>
		</div>

	</form>
	@include('layouts.errors')


  
@endsection