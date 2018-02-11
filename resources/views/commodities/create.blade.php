@extends('layouts.master')

@section('content')

<div class="col-sm-6">
	<div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Input Data Komoditas </h2>
            </div>

	<hr>

	<form method="POST" action="/commodity">
		{{csrf_field()}}



		<div class="col-sm-10">
		<div class="form-group">
			<label for="title">Nama Komoditas</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                <input type="text" class="form-control" id="name" name="name">
			</div>
		</div>

		<div class="form-group">
			<label for="title">Lama Tanam (hari)</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				<input type="integer" class="form-control" id="time" name="time">
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


@endsection	