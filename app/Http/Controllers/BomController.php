<?php

namespace App\Http\Controllers;
use App\Bom;
use App\Commodity;
use App\Komoditas;
use App\Outlet;
use App\Packaging;

use Illuminate\Http\Request;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $boms = Bom::all();
        return view('boms.index',compact('boms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$commodities = Commodity::all();
    	$outlets = Outlet::all();
        $packagings = Packaging::all();

        return view('boms.create', compact('commodities','outlets','packagings'));  
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
                
                'commodity_id'        =>  'required',
                'outlet_id'   =>  'required',
                'packaging_id'       =>  'required',
                'quantity'       =>  'required',
                
                ]);

            Bom::create(request(['packaging_id','commodity_id','outlet_id','quantity']));
            return redirect('/bom');    }

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

    public function edit(Bom $bom)

    {
        $commodities = Commodity::all();
        $outlets = Outlet::all();
        $packagings = Packaging::all();
        return view('boms.edit',compact('bom','commodities','outlets','packagings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 public function update(Bom $bom, Request $request)

    {

        $this->validate($request, [

            'commodity_id'        =>  'required',
            'outlet_id'   =>  'required',
            'packaging_id'       =>  'required',
            'quantity'       =>  'required',

        ]);

        $bom->update([
            'commodity_id' => $request->commodity_id,
            'outlet_id' => $request->outlet_id,
            'packaging_id' => $request->packaging_id,
            'quantity' => $request->quantity,
            
            
        ]);

        return redirect('/bom');
    }
    public function destroy(Bom $bom)
    {
        $bom->delete();
        return redirect('/bom');
    }

}