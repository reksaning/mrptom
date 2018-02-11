@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-body"><h2>Material Requirement Planning</h2></div>
</div>

<div class="row">
    <div class="col-md-4 col">
    <div class="panel panel-default">
        <div class="panel-heading">Pengaturan<i class="fa fa-gear fa-fw"></i></div>
        <div class="panel-body">

            <form method="GET" action="/forecast">
                <div class="form-group">
                    <label for="commodity_id">Pilih Komoditas</label>
                        <select class="form-control" id="commodity_id" name="commodity_id">
                            @foreach ($commodities as $commodity)
                                <option value="{{$commodity->id}}">{{$commodity->name}}</option>
                            @endforeach
                        </select>
                </div>
{{--                 <div class="form-group">
                    <label for="pusat_id">Supplier</label>
                        <select class="form-control" id="pusat_id" name="pusat_id">
                            @foreach ($outlets as $index => $item)
                                <option value="{{ $index }}">{{ $item }}</option>
                            @endforeach
                        </select>
                </div> --}}
{{--                 <div class="form-group">
                    <label for="periode">Periode (bulan)</label>
                        <select class="form-control" id="periode" name="periode">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>12</option>
                        </select>
                </div>   --}}


                <div class="form-group">
                    <button type="submit" class="btn btn btn-md">Proses</button>
                </div>

                
            </form>
        </div>
        </div>
    </div>

    <div class="col-md-8 col">
        {{-- @if (!empty($method))
            <h1>{{ $method }}</h1>
        @endif --}}
        <h2>Tabel Hasil Peramalan</h2>
        <table class="table table-hover">
            <thead>
                <tr class="success">
                    <th> Bulan </th>
                    @foreach ($outlets as $outlet)
                        <th>{{ $outlet->initial }} (pack)</th>
                    @endforeach
                    <th class="text-primary"><strong>Jumlah (pack)</strong></th>
                </tr>
            </thead>
            <tbody>
            

                @if ($forecasts != null)
                    @foreach ($monthly as $datas)
                        <tr>
                            <td class="warning">{{ $lastMonth->addMonths(1)->format('F Y')}}</td>
                            @foreach ($datas as $data)
                                <td>{{ round($data) }}</td>

                            @endforeach
                            <td class="text-primary">{{ round(array_sum($datas)) }}</td>
                        </tr>
                    @endforeach
                @endif
                @if ($forecasts != null)
                        <tr class="info">
                            <td>Metode Terpilih </td>
                            @foreach ($method as $metas)
                                <td>{{$metas}}</td>
                            @endforeach
                        </tr>
                        <tr class="danger">
                            <td>Error</td>
                            @foreach ($selisih as $error)
                                <td>{{round(($error),2)}}</td>
                            @endforeach
                        </tr>
                @endif
                
{{--         @if (!empty($kebutuhan))
            <h1>{{ $kebutuhan }}</h1>
        @endif --}}

            </tbody>
        </table>
    </div>
</div>

<div class = "row">
    <div class="col-md-12 col">
        <div class="row">
            <div class="col-md-6 col">
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
            </div>
            <div class="col-md-6 col">
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
    </div>
</div>


   


  <script type="text/javascript">
      $("#periode").val("{{ request('periode') }}");
      $("#commodity_id").val("{{ request('commodity_id') }}");
  </script>  
@endsection
