@extends('layouts.master')

@section('content')
<h1>Data Bahan Kemas</h1>	

	<div>
	{{-- <h1>Rata tanam {{ \App\Komoditas::rataLamaTanam() }}</h1> --}}
	
	  <table class="table table-hover">
	        <tr>
	        	<th> No </th>
	            <th> Bahan Kemas </th>
	            <th> Lama Pesan (hari) </th>
	            <th></th>
			</tr>

	        <?php $nomor = 0; ?>
	        @foreach ($packagings as $packaging)

	        <?php $nomor++ ?> 
	        <tr>
	        	<th> {{$nomor}}</th>
	            <td> {{$packaging->name}}</td>
	            <td> {{$packaging->time}} </td>
	            <td>

	            <div class="input-group">
                <span class="input-group-btn">
                    <a href="packaging/edit/{{ $packaging->id }}" class="btn btn-info btn-sm" role="button ">edit</a>
                </span>
               	<form action="/packaging/{{$packaging->id}}" method="POST">
	             {{ csrf_field() }}
	             {{ method_field('DELETE') }}
		            <button onclick="return confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-danger btn-sm">hapus</button>
	            </form>
              	</div>
	            </td>
	        </tr>
	        @endforeach
	</table>
	<a href="/packaging/create" class="btn btn-info" role="button">Tambahkan +</a>
	
	</div>
      


	
@endsection
