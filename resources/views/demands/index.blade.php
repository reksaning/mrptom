@extends('layouts.master')
@section('content')

      
<h1>Input Data Permintaan</h1>
  <hr>


  <div class="col-sm-12">

    <div class="form-group">
      <label for="title">Tanggal</label>
      <form method="GET" action="/demand">
        <div class="input-group">
              <input class="form-control datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" id="date" type="text" name="date" value="{{ request('date') }}">
                  <div class="input-group-btn">
                      <button class="btn btn-success" type="submit">Go</button>
                  </div>
            
        </div>
        </form>
    </div>
  <table class="table">
    <thead>
      <tr>
        <th> Nama Komoditas </th>
        @foreach ($outlets as $outlet)
          <th><a href="/demand/create?supplier_id={{$outlet->id}}&date={{ request('date') }}">{{$outlet->initial}}</a></th>
        @endforeach
      </tr>
      @foreach ($commodities as $commodity)
        <tr>
          <td>{{ $commodity->name }}</td>
          @foreach ($outlets as $outlet)
            <td>{{ empty($demand[$commodity->id][$outlet->id]) ? 0 : $demand[$commodity->id][$outlet->id]  }}</td>
          @endforeach
        </tr>
      @endforeach

    </thead>

  </table>
  @include('layouts.errors')


    <script src="/js/bootstrap-datepicker.js"></script>
  <script>
  $(".datepicker").datepicker({autoclose: true, todayHighlight: true});
  </script>

  
@endsection