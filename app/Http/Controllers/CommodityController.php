<?php

namespace App\Http\Controllers;
use App\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
     public function index()
    {
        
        $commodities=Commodity::all();

        return view('commodities.index',compact('commodities'));

    }

    public function create()

        {

            return view('commodities.create');

        } 

    public function store()

        {

            $this->validate(request(), [
                'name'        =>  'required',
                'time'       =>  'required'
                ]);

            Commodity::create(request(['name','time']));
            return redirect('/commodity');
        
        } 

    public function edit(Commodity $commodity)
    {

        return view('commodities.edit',compact('commodity'));

    }

    public function update(Commodity $commodity, Request $request)

    {
        $this->validate($request, [

            'name'        =>  'required',
            'time'       =>  'required'
        ]);

        $commodity->update([
            'name' => $request->name,
            'time' => $request->time,
        ]);

        return redirect('/commodity');
    }
    public function destroy(Commodity $commodity)
    {
        $commodity->delete();
        return redirect('/commodity');
    }
}
