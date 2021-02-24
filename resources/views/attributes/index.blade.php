@extends('layouts.store')

@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h3 class="display-4">Atributos</h3>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#attributesAdd">+ Novo atributo</button>


      <!-- <button type="button" class="btn btn-danger">- Excluir</button> -->
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Atributo</th>
                    <th scope="col">Valores</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            @php $aux = 1;
                        @endphp
            @foreach($listAttributes as $attribute)
            <tbody>
                <tr>
                    <th scope="row">{{$attribute->id}}</th>
                    <td>{{$attribute->name}}</td>
                    <td>
                        @php 
                        $items = App\Models\Attributes::listItemsByAttributeId($attribute->id);
                        $aux = 1;
                        @endphp

                        @foreach($items as $item)
                            {{$item->value}}
                            @if(count($items) != $aux) , @endif
                            @php $aux++; @endphp
                        @endforeach
                    </td>
                    <td>
                        <a href="/atributos/{{$attribute->id}}" >Editar</a> - 
                        <a href="/atributos/excluir/{{$attribute->id}}">Excluir</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>


<div class="modal fade" id="attributesAdd" tabindex="-1" role="dialog" aria-labelledby="attributesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="post">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="attributesLabel">Atributos do produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Digite nome do atributo">
            </div>

            <div class="form-group">
                <label for="value">Valor</label>
                <input type="text" class="form-control" name="value[]" placeholder="Digite o valor">
            </div>
            <div class="form-group">
                <label for="qtty">Quantidade</label>
                <input type="text" class="form-control" name="qtty[]" placeholder="Digite a quantidade">
            </div>

            <div class="container1" style="overflow-y: auto; height: 166px;">
                <button class="add_form_field btn btn-success">Novo atributo &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                <div>
                    
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="validCancel()">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </form>
  </div>
</div>


<script>
var validCancel = function() {
    document.getElementById('name').value = ''
    document.getElementById('value').value = ''
    document.getElementById('qtty').value = ''
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
            // if(x < max_fields){
                x++;
                $(wrapper).append(`
                <div>
                

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
            // }
        });
    
        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>
@endsection