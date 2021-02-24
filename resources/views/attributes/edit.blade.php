@extends('layouts.store')

@section('content')
    
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h3 class="display-1">Editar Atributos</h3>
    </div>

    <div class="container">
        <div class="card-deck mb-3 text-center">
            <form action="/atributos/update/{{$listAttribute->id}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$listAttribute->id}}">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite nome do atributo" value="{{$listAttribute->name}}">
                </div>

                @php $items = App\Models\Attributes::listItemsByAttributeId($listAttribute->id); @endphp
                @foreach($items as $item)
                <div>
                    <div class="form-group">
                        <input type="hidden" name="item_id[]" value="{{$item->id}}">
                        <label for="value">Valor</label>
                        <input type="text" class="form-control" name="value[]" placeholder="Digite o valor" value="{{$item->value}}">
                    </div>
                    <div class="form-group">
                        <label for="qtty">Quantidade</label>
                        <input type="text" class="form-control" name="qtty[]" placeholder="Digite a quantidade" value="{{intval($item->qtty)}}">
                    </div>
                    <a href="javascript:;" onclick="$(this).parent('div').remove(); deleteItems({{$item->id}})">Delete</a>
                </div>
                @endforeach

                <div class="form-group">
                    <a href="/atributos" type="button" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

                <div class="container1" style="overflow-y: auto; height: 366px;">
                    <button class="add_form_field btn btn-success">Novo atributo &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                    <div>
                        
                    </div>
                </div>

                
            </form>
        </div>
    </div>



<script>
var deleteItems = function (id) {
    var token = $("input[name*='_token']").val();
    $.post(`/atributos/deleteItems/${id}`, {id: id, _token: token})
}
</script>
<script>
    $(document).ready(function() {
        var max_fields      = 10;
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");
    
        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append(`
                <div>
                
                <input type="hidden" name="item_id[]" value="0">
                <div class="form-group">
                    <label for="value">Valor</label>
                    <input type="text" class="form-control" name="value[]" placeholder="Digite o valor">
                </div>
                <div class="form-group">
                    <label for="qtty">Quantidade</label>
                    <input type="text" class="form-control" name="qtty[]" placeholder="Digite a quantidade">
                </div>
                <a href="#" class="delete">Delete</a>
                </div>
                `); 
                //add input box
            } else {
                alert('You Reached the limits')
            }
        });
    
        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>
@endsection