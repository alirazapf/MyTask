<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//use App\Http\Controllers\product1;

class product1 extends Controller
{
    public function index()
    {
        $alldata = Product::all();
        return $alldata;
    }
}
