<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use Illuminate\Http\Request;
use App\Models\Products as modelProduct;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = modelProduct::all();
        return view('products.index', ['products' => $products]);
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
        $nameFile = '';
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $name = uniqid(date('Ymd'));
            $extension = $request->file->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->file->storeAs('products', $nameFile);
        }

        $name = $request->input('name');
        $code = $request->input('code');
        $price = $request->input('price');

        $products = new modelProduct();
        $product_id = $products->add([
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'file' => $nameFile
        ]);

        $attributes = $request->input('attributes');
        $attributesItems = $request->input('attributesItems');

        foreach ($attributes as $k => $attribute) {
            $attributeId = $attribute;
            $attributesItemsId = $attributesItems[$k];

            $products->addProductsAttributes([
                'product_id' => $product_id, 
                'attribute_id' => $attributeId,
                'attribute_item_id' => $attributesItemsId
            ]);
        }

        return redirect('/produtos');
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
        $modelAttributes = new modelProduct();
        $modelAttributes->_delete($id);

        $searchProduct = modelProduct::find($id);
        if (isset($searchProduct)) {
            $searchProduct->delete();
        }

        return redirect('/produtos')->with('success','Produto excluído com sucesso');
    }

    public function attributes()
    {
        $attributes = new Attributes();
        return $attributes::all();
    }

    public function attributesItems($attribute_id)
    {
        $attributes = new Attributes();
        return $attributes->getAttributeItemByIdAttribute($attribute_id);
    }

    public function getAll()
    {
        return modelProduct::all();
    }
}
