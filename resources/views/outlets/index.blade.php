@extends('layouts.master')

@section('content')
<h1>Data Uotlet</h1>	

	<div>
	{{-- <h1>Rata tanam {{ \App\Komoditas::rataLamaTanam() }}</h1> --}}
	
	  <table class="table table-hover">
	        <tr>
	        	<th> No </th>
	            <th> Outlet </th>
	            <th> Inisial </th>
	            <th> Alamat </th>
	            <th></th>
			</tr>

	        <?php $nomor = 0; ?>
	        @foreach ($outlets as $outlet)

	        <?php $nomor++ ?> 
	        <tr>
	        	<th> {{$nomor}}</th>
	            <td> {{$outlet->name}}</td>
	            <td> {{$outlet->initial}}</td>
	            <td> {{$outlet->address}} </td>

	            <td>
	            <div class="input-group">

					    <span class="input-group-btn">
					        <a href="outlet/edit/{{ $outlet->id }}" class="btn btn-info btn-sm" role="button ">edit</a>
					    </span>

					    <form action="/outlet/{{$outlet->id}}" method="POST">
			             {{ csrf_field() }}
			             {{ method_field('DELETE') }}
				            <button onclick="return confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-danger btn-sm">hapus</button>
			            </form>

				</div>
				
	            

	            


	            </td>
	        </tr>
	        @endforeach
	</table>
	<a href="/outlet/create" class="btn btn-info" role="button">Tambahkan +</a>
	
	</div>
      


	
@endsection
