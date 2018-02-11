@extends('layouts.master')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Rekap  <small>Permintaan</small>
        </h1>
    </div>
</div>

<div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>New Comments!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>New Tasks!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Grafik </h2>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart">
                	




{{-- Input (pemilihan commodity) --}}
<div class="row">
    <div class="col-md-4 col">
    <div class="panel panel-default">
        <div class="panel-heading">Pengaturan<i class="fa fa-gear fa-fw"></i></div>
        <div class="panel-body">

            <form method="GET" action="/dashboard">
                <div class="form-group">
                    <label for="commodity_id">Nama Sayuran</label>
                        <select class="form-control" id="commodity_id" name="commodity_id">
                            @foreach ($commodities as $commodity)
                                <option value="{{$commodity->id}}">{{$commodity->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="row"> 
                    <div class="form-group">
                        <button type="submit" class="btn btn btn-md">Proses</button>
                    </div>
                </div>
                
            </form>
        </div>
        </div>
    </div>

{{-- {{$bulanSales}} --}}
{{-- Grafik --}}

  <script type="text/javascript">

      $("#commodity_id").val("{{ request('commodity_id') }}");
  </script>  


<div class="col-md-8 col">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Permintaan"
	},
	axisX:{
		title: "Periode Bulan",
		valueFormatString: "",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: "Jumlah (pcs)",
		crosshair: {
			enabled: true
		}
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},
	data: [
	@isset ($data)
		@foreach ($data as $key => $items)
				{
					type: "line",
					showInLegend: true,
					name: "{{ $key }}",
					markerType: "square",
					xValueFormatString: "",
					color: "{{ $colors[$loop->index] }}",
					dataPoints: [
			            @foreach ($items as $key => $element)
				
							{ label:  "{{ $key }}"  , y: {{ $element }}},

			            @endforeach	
					]
			},
		@endforeach
	@endisset
		
	]
});
chart.render();

function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="/js/jquery.canvasjs.min.js"></script>
</div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection