@extends('layouts.master')

@section('content')
<div class="col-sm-8">


<h1>Data Komoditas</h1>	

	<div>
	{{-- <h1>Rata tanam {{ \App\Komoditas::rataLamaTanam() }}</h1> --}}
	
	  <table class="table table-hover">
	        <tr>
	        	<th> No </th>
	            <th> Komoditas </th>
	            <th> Lama tanam (hari) </th>
	            <th></th>
			</tr>

	        <?php $nomor = 0; ?>
	        @foreach ($commodities as $commodity)

	        <?php $nomor++ ?> 
	        <tr>
	        	<th> {{$nomor}}</th>
	            <td> {{$commodity->name}}</td>
	            <td> {{$commodity->time}}</td>
	            <td>
	  				<div class="input-group">

					    <span class="input-group-btn">
					        <a href="commodity/edit/{{ $commodity->id }}" class="btn btn-info btn-sm" role="button ">edit</a>
					    </span>

					    <form action="/commodity/{{$commodity->id}}" method="POST">
			             {{ method_field('DELETE') }}
				            <button onclick="return confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-danger btn-sm">hapus</button>
			            </form>

				    </div>
	            </td>
	        </tr>
	        @endforeach
	</table>
	<a href="/commodity/create" class="btn btn-info" role="button">Tambahkan +</a>
	
	</div>
      

</div>
	
@endsection
