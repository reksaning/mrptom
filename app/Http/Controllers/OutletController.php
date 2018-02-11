<?php

namespace App\Http\Controllers;
use App\Outlet;
use App\Commodity;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        
        $outlets = Outlet::all();

        return view('outlets.index',compact('outlets'));

    }


    public function create()
        {
            return view('outlets.create');
        } 

    public function store()
        {
            $this->validate(request(), [
                'name'        =>  'required',
                'initial'        =>  'required',
                'address'       =>  'required'
                ]);

            Outlet::create(request(['name','initial','address']));
            return redirect('/outlet');
        } 

    public function edit(Outlet $outlet)

    {


        return view('outlets.edit',compact('outlet'));

    }

    public function update(Outlet $outlet, Request $request)

    {
        $this->validate($request, [

            'name'        =>  'required',
            'initial'       =>'required',
            'address'       =>  'required'

        ]);

        $outlet->update([
            'name' => $request->name,
            'initial' => $request->initial,
            'address' => $request->address,
        ]);

        return redirect('/outlet');
    }
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return redirect('/outlet');
    }

}

