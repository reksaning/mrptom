<?php

namespace App\Http\Controllers;
use App\Packaging;
use Illuminate\Http\Request;

class PackagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagings=Packaging::all();
        return view('packagings.index',compact('packagings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $packagings=Packaging::all();
        
        return view('packagings.create',compact('packagings'));  
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
                'name'       =>  'required',
                'time'        =>  'required'
                ]);

            Packaging::create(request(['name','time']));
            return redirect('/packaging');    }

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

    public function edit(Packaging $packaging)

    {
        return view('packagings.edit',compact('packaging'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 public function update(Packaging $packaging, Request $request)

    {

        $this->validate($request, [

            'name'       =>  'required',
            'time'        =>  'required'

        ]);

        $packaging->update([
            'name' => $request->name,
            'time' => $request->time,
            
        ]);

        return redirect('/packaging');
    }
    public function destroy(Packaging $packaging)
    {
        $packaging->delete();
        return redirect('/packaging');
    }

}