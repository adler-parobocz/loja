<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stocks extends Model
{
    use HasFactory;

    public function getAllAttributesProduct($produto_id)
    {
        return DB::select("select a.name, ai.value, ai.qtty from products_attributes pa
        inner join attributes a on a.id = pa.attribute_id
        inner join attributes_items ai on ai.id = a.id
        where pa.product_id = $produto_id");
    }
}
