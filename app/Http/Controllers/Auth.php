<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks as modelStocks;

class Auth extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('stock.index');
    }
}
