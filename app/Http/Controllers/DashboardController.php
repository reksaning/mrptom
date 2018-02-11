<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commodity;
use App\Demand;
use App\Outlet;

class DashboardController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $commodities = Commodity::all();
        $outlets = Outlet::all();



        if (request()->has('commodity_id')) {
            $year = request('year');
            $months = Demand::where('date', 'like', "%$year%")->orderBy('date', 'desc')->get()->sortBy('bulan')->pluck('bulan')->unique()->values();

            $demands = Demand::where('date', 'like', "%$year%")->where('commodity_id', request('commodity_id'))->orderBy('date', 'desc')->get();

            foreach ($outlets as $outlet) {
                foreach ($months as $month) {
                    $data[$outlet->name][$month] = $demands->where('outlet_id', $outlet->id)->where('bulan', $month)->sum('jumlah');
                }
            }
            // $dataGrafiks=Demand::where('commodity_id', request('commodity_id'))->pluck('jumlah');
            // $dataGrafiksProd=Produksi::where('commodity_id', request('commodity_id'))->pluck('jumlah');
        } 

        else {
            $dataGrafiks = null ;
            $dataGrafiksProd = null ;
            $komoditases1 = null ;
        }

        $colors = collect(['red', 'blue', 'green', 'yellow']);

        return view('dashboards.home', compact('commodities', 'data', 'colors'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cusmon()
    {
        return view('dashboards.cusmon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
