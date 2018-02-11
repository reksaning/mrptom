@extends('layouts.master')

@section('content')
<h1>Bill of Materials</h1> 

  <div>
  {{-- <h1>Rata tanam {{ \App\Komoditas::rataLamaTanam() }}</h1> --}}
  
    <table class="table table-hover">
          <tr>
            <th> No </th>
            <th> Komoditas </th>
            <th> Outlet </th>
            <th> Konversi </th>
            <th> Bahan Kemas </th>
            <th></th>
      </tr>

          <?php $nomor = 0; ?>
          @foreach ($boms as $bom)

          <?php $nomor++ ?> 
          <tr>
            <th> {{$nomor}}</th>
              <td> {{$bom->commodity->name}}</td>
              <td> {{$bom->outlet->name}}</td>
              <td> {{$bom->quantity}} </td>
              <td> {{$bom->packaging->name}} </td>
              <td>

              <div class="input-group">
                <span class="input-group-btn">
                    <a href="bom/edit/{{ $bom->id }}" class="btn btn-info btn-sm" role="button ">edit</a>
                </span>
                <form action="/bom/{{$bom->id}}" method="POST">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                  <button onclick="return confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-danger btn-sm">hapus</button>
                </form>

              </div>
              </td>
          </tr>
          @endforeach
  </table>
  <a href="/bom/create" class="btn btn-info" role="button">Tambahkan +</a>
  
  </div>
      


  
@endsection
