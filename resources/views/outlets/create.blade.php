@extends('layouts.master')

@section('content')

<div class="col-sm-6">
	<div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Input Data Outlet </h2>
            </div>

	<hr>

	<form method="POST" action="/outlet">
		{{csrf_field()}}

	<div class="col-sm-10">
		<div class="form-group">
			<label for="title">Nama Outlet</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
				<input type="text" class="form-control" id="name" name="name">
			</div>
		</div>
		<div class="form-group">
			<label for="title">Inisial</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-text-background"></i></span>
				<input type="text" class="form-control" id="initial" name="initial">
			</div>
		</div>
		<div class="form-group">
			<label for="title">Alamat</label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<input type="text" class="form-control" id="address" name="address">
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