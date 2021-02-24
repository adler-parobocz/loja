@extends('layouts.store')

@section('content')
    

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">Estoque</h1>
      <a href="/estoque/entrada" class="btn btn-success">Entrada</a>
      <a href="" class="btn btn-danger">Saida</a>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>

<div class="modal fade" id="stockInput" tabindex="-1" role="dialog" aria-labelledby="attributesLabel" aria-hidden="true">
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
                <label for="name">Produto</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Digite nome do atributo">
            </div>

            <div class="form-group">
                <label for="value">Quantidade</label>
                <input type="text" class="form-control" name="value[]" placeholder="Digite o valor">
            </div>
            <div class="form-group">
                <label for="qtty">Custo unitário</label>
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
@endsection