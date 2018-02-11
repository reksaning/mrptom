@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-body"><h2>Tabel Kebutuhan Bahan</h2></div>
</div>

<div class = "row">
    <div class="col-md-12 col">
            @foreach ($commodities as $commodity)
                <h2>{{$commodity->name}}</h2>
                
                @if (!empty($name))
                    <h2>Kebutuhan {{$name}} </h2>
                @endif 

                <table class="table table-hover">
                    <thead>
                        <tr class="success">
                            <th> Kebutuhan Bulan </th>
                            <th> Jumlah (kg) </th>
                            <th class="text-primary">
                                <strong> Harian (kg) </strong>
                            </th>
                            <th> Mulai Dipesan Tanggal </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($forecasts != null)
                            @foreach ($monthlyKg as $datas)
                                <tr>
                                    <td class="warning">{{ $lastMonthNeed->addMonths(1)->startOfMonth()->format('F Y')}}</td>
                                    <td>{{ round(array_sum($datas)) }}</td>
                                    <td class="text-primary">{{ round((array_sum($datas)/30),2) }}</td>
                                    <td class="danger">{{ $lastMonthOrder->addMonths(1)->format('d F Y')}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            @endforeach
        
    </div>
</div>
<div class = "row">
    <div class="col-md-12 col">
        <h2>Bahan Kemas </h2>
    <table class="table table-hover">
        <thead>
            <tr class="success">
                    @if (!empty($packagings))
                        @foreach ($packagings as $packaging)
                            <th>{{ $packaging->name }}</th>
                        @endforeach
                    @endif
                <th> Dipesan Tanggal </th>
            </tr>
        </thead>
        <tbody>
            @if ($forecasts != null)
                @foreach ($monthly as $datas)
                    <tr>
                    @foreach ($datas as $data)
                        <td>{{ round($data) }} (pcs) </td>
                    @endforeach
                        <td class="danger">{{ $lastMonthOrderKemasan->addMonths(1)->format('d F Y')}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>


  <script type="text/javascript">
      $("#periode").val("{{ request('periode') }}");
      $("#commodity_id").val("{{ request('commodity_id') }}");
  </script>  
@endsection
