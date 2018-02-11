<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Commodity;
use App\Outlet;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commodities = Commodity::all();
        // $demand=Demand::all();
        $outlets = Outlet::all();
        foreach (Demand::where('date', request('date'))->get() as $result) {
            $demand[$result->commodity_id][$result->outlet_id] = $result->quantity;
        }
        // return $demand;
        return view('demands.index', compact('commodities', 'demand','outlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $demand=Demand::where('date', request('date'))->where('outlet_id', request('outlet_id'))->get() ;

    
        if (empty($demand->first())) {
            $commodities = Commodity::all();
            return view('demands.create', compact(['demand', 'commodities']));
        }
         
        return view('demands.edit', compact('demand', 'commodities' ));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'commodity_id'       =>  'required',
                'outlet_id'   =>  'required',
                'date'        =>  'required',
                'quantity'   =>  'required'
                ]);

        // return $request->all();
        $n=0;
        foreach ($request->quantity as $quantity) {
            $demand = Demand::create([
                'commodity_id' => $request->commodity_id[$n],
                'outlet_id' => $request->outlet_id,
                'date' => $request->date,
                'quantity' => $quantity,
            ]);
            $n++;
        }
            return redirect("/demand?date=$request->date");    
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

    public function edit(Demand $demand)

    {
         $commodities=Commodity::all();

        return view('demands.edit',compact('demand','commodities'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 public function update(Request $request)

    {

        $n = 0;
        foreach ($request->demand_id as $id) {
            Demand::find($id)->update([
                'quantity' => $request->quantity[$n],
            ]);
            $n++;
        }


        return redirect('/demand');
    }

    public function destroy(Demand $demand)
    {
        $demand->delete();
        return redirect('/demand');
    }

}