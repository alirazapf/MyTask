<?php

namespace App\Http\Controllers;
//use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Category;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request)
    {
       
        $input = $request->all();
        \App\Models\Product::create($input);
        return response()->json(['status'=>true, 'message' => "New product added", $input]);
        //return \App\Models\Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $alldata = \App\Models\Product::all();
        return $alldata;
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


        $Product = \App\Models\Product::findOrFail($id);
        $Product->update($request->all());

        return $Product;





        // $temp = Product::find($id);
        // $input=$request->all();
        // $validator = Validator::make(
        //     $input,
        //     [
        //         'title' => 'required',
        //         'descripition' => 'required',
        //         'price' => 'required'
        //     ]);

        // $temp->title = $input['title'];
        // $temp->description = $input['description'];
        // $temp->price = $input['price'];
        // $temp->save();







        // $request->validate([
        //     'stock_name'=>'required',
        //     'ticket'=>'required',
        //     'value'=>'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        // ]); 
        // $stock = \App\Models\Product::find($id);
        // // Getting values from the blade template form
        // $stock->title =  $request->get('title');
        // $stock->description = $request->get('description');
        // $stock->price = $request->get('price');
        // $stock->save();
        // return 'sucessfully update';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\Models\Product::find($id);
        $data->delete();
        return 'sucessfully delete';
        
    }
}
