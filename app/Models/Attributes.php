<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attributes extends Model
{
    use HasFactory;

    public function add($name) {
        $attributes = new Attributes();
        $attributes->name = $name;
        $attributes->save();
        return $attributes->id;
    }

    public function edit($name, $id) {
        $attributes = Attributes::find($id);
        $attributes->name = $name;
        $attributes->save();
        return $attributes->id;
    }

    public function _delete($attribute_id)
    {
        DB::beginTransaction();
        try{
            DB::delete("delete from attributes where id = $attribute_id");
            DB::delete("delete from attributes_items where attributes_id = $attribute_id");
        }catch(\Exception $e){
            DB::rollback();
        }
        DB::commit();
    }

    public function listAllItems() 
    {
        return DB::select("
        select attributes.id, attributes.name, items.value, items.qtty from attributes 
        inner join attributes_items as items on items.attributes_id = attributes.id
        ");
    }

    static public function listItemsByAttributeId($attribute_id)
    {
        return DB::select("select * from attributes_items where attributes_id = $attribute_id");
    }

    public function getAllAttributes()
    {
        return Attributes::all();
    }

    public function getAttributeItemByIdAttribute($attribute_id)
    {
        return DB::select("select * from attributes_items where attributes_id = $attribute_id");
    }
}
