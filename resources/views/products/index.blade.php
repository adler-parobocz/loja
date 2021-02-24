@extends('layouts.store')

@section('content')
    

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">Produtos</h1>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#productAdd">+ Novo Produto</button>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nome</th>
                <th scope="col">Código</th>
                <th scope="col">Valor de venda</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>
                        <img width="100" src="{{ url("storage/products/$product->file") }}">
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                    editar - 
                    <a href="/produtos/excluir/{{$product->id}}">Excluir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <div class="modal fade" id="productAdd" tabindex="-1" role="dialog" aria-labelledby="attributesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/produtos/adicionar" method="post" enctype="multipart/form-data">
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
                    <label for="name">Código</label>
                    <input type="text" class="form-control" name="code" id="name" placeholder="Digite nome do atributo">
                </div>

                <div class="form-group">
                    <label for="value">Valor de venda</label>
                    <input type="text" class="form-control" name="price" placeholder="Digite o valor">
                </div>
                <div class="form-group">
                    <label for="value">Foto</label>
                    <input type="file" class="form-control" name="file">
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
    // document.getElementById('name').value = ''
}
</script>
<script>
    $(document).ready(function() {
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");
    
        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            
            var _option;

            $.get('/produtos/atributos', function(options) {
                for (var val in options) {
                    // console.log(options[val].id, options[val].name)
                    _option = $('<option value="' + options[val].id + '">' + options[val].name + '</option>');
                    
                    $('#attributes-' + (x-1)).append(_option);
                }
                // console.log('qual meu x?', x)
                // $('#attributes-' + (x-1)).append($('<option>', {
                //     value: 1,
                //     text: 'My option'
                // }));
            })

            
            $(wrapper).append(`
            <div>
            

            <div class="form-group">
                <label for="value">Atributos</label>
                <select name="attributes[]" id="attributes-${x}">
                    <option value='0'>Selecione</option>
                </select>
            </div>
            <div class="form-group" id='div-items-${x}'>
                <select name="attributesItems[]" class="form-control" id="atributes-items-${x}"></select>
            </div>
            <a href="#" class="delete">Delete</a>
            </div>
            `);


            $(`#attributes-${x}`).change(function(){
                let id = $(this).val();

                var __option, __selectItems

                // $('#div-items-' + id).empty()

                $.get(`/produtos/attributosItens/${id}`, function(items) {
                    console.log('ID:: ', x-1)
                    // $('#div-items-' + id).empty()    
                    
                    $.each(items, function (i, item) {
                        // console.log(i, item.attributes_id, item.value, item.qtty)
                        console.log(i, item.attributes_id, item.value)
                        // __selectItems = `<select name="attributesItems[]" class="form-control" id="items-${id}"></select>`
                        __option = $('<option value="' + item.id + '">' + item.value + '</option>');
                    
                        $('#atributes-items-' + id).append(__option);

                    //     console.log('meu x: ' , (x-1))

                    // $('#Aitems-' + (x-1)).append($('<option>', {
                    //     value: 1,
                    //     text: 'My option'
                    // }));
                        
                    });
                    $('#div-items-' + id).append(__selectItems)
                })

                
            })

            function createSelect(attribute_id){
                let html = `<select name="attributesItems[]" class="form-control" id="items-${attribute_id}"></select>`; 
                
                return html;
            }


            x++;
            
        });
    
        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>
@endsection