@extends('layouts.store')

@section('content')
    

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
      <h1 class="display-4">Estoque - Entrada - {{$product->name}}</h1>      
    </div>

    <div class="container">
        <div class="card-deck mb-3 text-center">
            <form action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Variações de produto</label>
                    
                </div>

                <div class="container1" style="overflow-y: auto; height: 466px;">
                    <button class="add_form_field btn btn-success">Variação &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                    <div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        var max_fields      = 10;
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");
    
        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
                
                $(wrapper).append(`
                <div>
                

                <div class="form-group">
                    <label for="value">Valor</label>
                    <select name="attributes[]" id="attributes-${x}">

                    </select>
                </div>
                <div class="form-group">
                    <label for="qtty">Quantidade</label>
                    <input type="text" class="form-control" name="qtty[]" placeholder="Digite a quantidade">
                </div>
                <a href="#" class="delete">Delete</a>
                </div>
                `); 
                getAllAttributes(x)
                x++;
        });
    
        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });

    function getAllAttributes(id) {
        $.get('/estoque/getAllAttributesProduct/'+id, function(items) {
            $.each(items, function (i, item) {
                var __option = $('<option value="' + item.id + '">' + item.name + '</option>');
                $('#attributes-' + id).append(__option);
            })
        })
    }
</script>
@endsection