<?php

namespace App\Http\Controllers;

use App\Models\Attributes as ModelAttributes;
use App\Models\Attributes_Items;
use Attribute;
use Illuminate\Http\Request;

class Attributes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allAttributes = ModelAttributes::all();
        // $modelAttributes = new ModelAttributes();

        // $attr = [];
        // $attrItems = [];

        // foreach ($allAttributes as $attribute) {
        //     // echo $attribute->name;
            
        //     array_push($attr, [
        //         'name' => $attribute->name
        //     ]);

        //     $items = $modelAttributes->listItemsByAttributeId($attribute->id);
        //     foreach($items as $item) {
                
        //         array_push($attr, [$item->value, $item->qtty]);

        //         // echo $item->value;
        //         // echo $item->qtty;
        //         // echo "<br>";
        //     }
        //     // echo "<hr>";
        // }

        

        $modelAttributes = new ModelAttributes();
        $listAllItems = $modelAttributes->listAllItems();

        return view('attributes.index', [
            'listAttributes' => ModelAttributes::all()]
        );
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
        $modelAttributes = new ModelAttributes();
        $modelAttributesItems = new Attributes_Items();

        $name = $request->input('name');

        $lastId = $modelAttributes->add($name);

        $values = $request->input('value');
        $qttys = $request->input('qtty');

        foreach ($values as $k => $value) {
            echo $value;
            echo $qttys[$k] . '<br>';

            $data = [
                'attributes_id' => $lastId,
                'value' => $value,
                'qtty' => $qttys[$k]
            ];
            $modelAttributesItems->add($data);
        }

        return redirect('/atributos')->with('success','Atributo adicionado com sucesso');;
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

        return view('attributes.edit', [
            'listAttribute' => ModelAttributes::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $attribute_id)
    {
        $modelAttributes = new ModelAttributes();
        $modelAttributesItems = new Attributes_Items();

        $id = $request->input('id');
        $name = $request->input('name');

        $modelAttributes->edit($name, $attribute_id);

        $values = $request->input('value');
        $qtty = $request->input('qtty');
        $items_id = $request->input('item_id');
        
        if ($items_id) {
            foreach ($items_id as $k => $item_id) {
                echo $attribute_id . ' - ' . $item_id . ' - '. $values[$k] .' - '. $qtty[$k];
                echo '<br>';
                if ($item_id == 0) {
                    $data = [
                        'attributes_id' => $attribute_id,
                        'value' => $values[$k],
                        'qtty' => $qtty[$k]
                    ];
                    $modelAttributesItems->add($data);
                } else {
                    $modelAttributesItems->edit($attribute_id, $item_id, $values[$k], $qtty[$k]);
                }
            }
        }

        return redirect('/atributos')->with('success','Atributo alterado com sucesso');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelAttributes = new ModelAttributes();
        $modelAttributes->_delete($id);

        return redirect('/atributos')->with('success','Atributo excluído com sucesso');
    }

    /**
     * Remove items specified from attributes
     * 
     * @param int $id
     */
    public function deleteItems($id)
    {
        $modelAttributesItems = Attributes_Items::find($id);
        if (isset($modelAttributesItems)) {
            $modelAttributesItems->delete();
        }
    }
}
