<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks as modelStocks;
use App\Models\Products as modelProduct;

class Stock extends Controller
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

    public function entry()
    {
        $allStock = modelStocks::all();
        return view('stock.input', ['allStocks' => $allStock]);
    }

    public function addEntry($product_id)
    {
        $allStock = modelStocks::all();
        $product = modelProduct::find($product_id);
        
        return view('stock.add_input', ['allStocks' => $allStock, 'product' => $product]);
    }

    public function getAllAttributesProduct($product_id)
    {
        $modelStocks = new modelStocks();
        return $modelStocks->getAllAttributesProduct($product_id);
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
    public function store(Request $request)
    {
        $modelStock = new modelStocks();
        $modelProduct = new modelProduct();

        $product = $modelProduct->find($request->input('products'));

        $modelStock->name = $product->name;
        $modelStock->product_id = $product->id;
        $modelStock->save();

        return redirect('/estoque/entrada');

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
