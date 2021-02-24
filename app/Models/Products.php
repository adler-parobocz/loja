<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

    public function add($data) 
    {
        $products = new Products();
        $products->name = $data['name'];
        $products->code = $data['code'];
        $products->price = $data['price'];
        $products->file = $data['file'];

        $products->save();

        return $products->id;
    }

    public function addProductsAttributes($data) 
    {
        $product_id = $data['product_id'];
        $attribute_id = $data['attribute_id'];
        $attribute_item_id = $data['attribute_item_id'];
        DB::insert("insert into products_attributes (product_id, attribute_id, attribute_item_id) values ($product_id, $attribute_id, $attribute_item_id)");
    }

    public function _delete($product_id)
    {
        DB::beginTransaction();
        try{
            DB::delete("delete from products_attributes where product_id = $product_id");
        }catch(\Exception $e){
            DB::rollback();
        }
        DB::commit();
    }
}
