<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Bom;
use App\Commodity;
use App\Packaging;
use App\Outlet;
use Illuminate\Http\Request;

class MrpController extends Controller
{
    

	public function index(Request $request)
    
    {
        $demands = Demand::all();
        $commodities = Commodity::all();
        $packagings = Packaging::all();
        $outlets = Outlet::all();

        // $induks = collect([ 1 => 'Superindo', 2 => 'Indogrosir', 3 => 'Giant']);

        if (request()->has('commodity_id')) {

            foreach ($outlets as $key => $item) {

                $request->merge(['outlet_id' => $key]);

                $boms[$key]=Bom::where('commodity_id', request('commodity_id'))->where('outlet_id', request('outlet_id'))->first()->quantity;

                $mrp = [

                    // \App\Demand::dekomposisi(),
                    \App\Demand::movingAverage(),
                    \App\Demand::SES(),
                    \App\Demand::DES(),

                ];

                $collection = collect($mrp);

                $val = $collection->sortBy('error')->first();

                $forecasts[$key] = collect($val['H'])->values()->take(3);
                $kebutuhan[$key] = $forecasts[$key]->sum();
                $method[$key] = $val['method'];
                $selisih[$key] = $val['error'];
                // $forecasts = Demand::dekomposisi()['H'];

            }

            for ($i = 0; $i < 3; $i++) { 
                foreach ($outlets as $key => $value) {
                    $monthlyKg[$i][$key] = $forecasts[$key][$i]* $boms[$key] ;
                                        // 
                }
            }

            for ($i = 0; $i < 3; $i++) { 
                foreach ($outlets as $key => $value) {
                    $monthly[$i][$key] = $forecasts[$key][$i] ;
                                        // * $boms[$key]
                }
            }

            //untuk tabel MRP
            $nama=Commodity::where('id', request('commodity_id'))->first()->name;
            $leadTime = Commodity::where('id', request('commodity_id'))->first()->time;

            $lastMonth = Demand::where('commodity_id', request('commodity_id'))->orderBy('date', 'desc')->first()->date;
            $lastMonthNeed = Demand::where('commodity_id', request('commodity_id'))->orderBy('date', 'desc')->first()->date;
            $lastMonthOrder = Demand::where('commodity_id', request('commodity_id'))->orderBy('date', 'desc')->first()->date->startOfMonth()->subDays($leadTime+7);
            $lastMonthOrderKemasan = Demand::where('commodity_id', request('commodity_id'))->orderBy('date', 'desc')->first()->date->startOfMonth()->subDays(14);

        } else {

            $forecasts = null ;
            $lastMonth = null ;

        }
        
        // return [$forecasts,$monthly];
        return view('mrp.index',compact('demand','commodities','packagings', 'forecasts','lastMonth', 'lastMonthNeed', 'leadTime','lastMonthOrder', 'method', 'kebutuhan', 'outlets', 'monthly', 'monthlyKg', 'nama', 'lastMonthOrderKemasan','selisih'));
    }


}
