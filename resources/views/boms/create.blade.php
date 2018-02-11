@extends('layouts.master')
@section('content')


<div class="col-sm-6">
	<div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Input Data Bill of Material </h2>
            </div>

	<hr>

	<form method="POST" action="/bom">
		{{csrf_field()}}

	<div class="col-sm-10">

		<div class="form-group">
			<label for="commodity_id">Komoditas</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
				<select class="form-control" id="commodity_id" name="commodity_id">

				@foreach ($commodities as $commodity)
					<option value="{{$commodity->id}}">{{$commodity->name}}</option>
				@endforeach

				</select> 
			</div>
		</div>

		<div class="form-group">
			<label for="outlet_id">Outlet</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<select class="form-control" id="outlet_id" name="outlet_id">

				@foreach ($outlets as $outlet)
					<option value="{{$outlet->id}}">{{$outlet->name}}</option>
				@endforeach

				</select> 
			</div>
		</div>

		<div class="form-group">
			<label for="title">1 pcs = ...kg </label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-transfer"></i></span>
				<input type="integer" class="form-control" id="quantity" name="quantity">
			</div>
		</div>

		<div class="form-group">
			<label for="packaging_id">Bahan Kemas</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
				<select class="form-control" id="packaging_id" name="packaging_id">

				@foreach ($packagings as $packaging)
					<option value="{{$packaging->id}}">{{$packaging->name}}</option>
				@endforeach

				</select>
			</div> 
		</div>

			<hr>
			
			<div class="form-group">
				<button type="submit" class="btn btn-secondary">Kirim</button>
			</div>

	</div>
	
	</form>

	@include('layouts.errors')

	</div>
</div>


@endsection