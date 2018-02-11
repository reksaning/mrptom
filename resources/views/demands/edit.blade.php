@extends('layouts.master')
@section('content')


<h1>Edit Data Permintaan</h1>
	<hr>
		<form method="POST" action="/demand">
		{{csrf_field()}}
		{{ method_field('PUT') }}

	<div class="col-sm-6">

	<div>
	<table class="table">
		<thead>
			<tr>
				<th> Komoditas </th>
			</tr>
		</thead>
		<tbody>

			@foreach ($demand as $data)
			<tr>
				<th>
					
					<input type="hidden" name="demand_id[{{ $loop->index }}]" value="{{$data->id}}"><label>{{$data->commodity->name}} </label>
					<input type="integer" class="form-control" id="quantity" name="quantity[{{ $loop->index }}]" value="{{$data->quantity}}">
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