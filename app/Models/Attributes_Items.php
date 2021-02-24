<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attributes_Items extends Model
{
    use HasFactory;
    protected $table = 'attributes_items';

    public function add($data) 
    {
        $attributesItems = new Attributes_Items();
        $attributesItems->attributes_id = $data['attributes_id'];
        $attributesItems->value = $data['value'];
        $attributesItems->qtty = $data['qtty'];
        $attributesItems->save();
    }

    public function edit($attribute_id, $item_id, $value, $qtty)
    {
        DB::update("update attributes_items set value = '$value', qtty = '$qtty' where id = ? and attributes_id = ?", 
            [
                $item_id,
                $attribute_id
            ]
        );
    }
}
