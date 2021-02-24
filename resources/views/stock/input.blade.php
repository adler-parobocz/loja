@extends('layouts.store')

@section('content')
    

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">Estoque - Entrada</h1>
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#stockInput">Adicionar Produto</a>
      <a href="" class="btn btn-danger">Saida</a>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allStocks as $allStock)
                <tr>
                    <th scope="row">{{$allStock->id}}</th>
                    <td>{{$allStock->name}}</td>
                    <td>
                        <a href="/estoque/adicionarEntrada/{{$allStock->id}}">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<div class="modal fade" id="stockInput" tabindex="-1" role="dialog" aria-labelledby="attributesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/estoque/adicionar" method="post">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">Adicionar estoque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="name">Produto</label>
                <select name="products" id="products-0">
                    <option value="0">Selecione</option>
                </select>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </form>
  </div>
</div>

<script>
    getAllProducts(0)

    function getAllProducts(id) {
        $.get('/produtos/getAll', function(items) {
            $.each(items, function (i, item) {
                var __option = $('<option value="' + item.id + '">' + item.name + '</option>');
                $('#products-' + id).append(__option);
            })
        })
    }
    

    
</script>
@endsection