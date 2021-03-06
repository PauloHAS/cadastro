@extends('layouts.app',["current"=> "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos/{{$prods->id}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" value="{{$prods->name}}" id="nomeProduto" placeholder="Produto">
                </div>

                <div class="form-group">
                    <label for="estoqueProduto">Estoque</label>
                <input type="number" class="form-control" name="estoqueProduto" value="{{$prods->stock}}" id="estoqueProduto"
                        placeholder="Estoque">
                </div>

                <div class="form-group">
                    <label for="precoProduto">Preço</label>
                    <input type="number" class="form-control" name="precoProduto" value="{{$prods->price}}" id="precoProduto" placeholder="Preço">
                </div>

                <div class="form-group">
                    <label for="categoriaProduto">Categoria</label>
                <select class="form-control" name="categoriaProduto" value="{{$prods->categoria_id}}" id="categoriaProduto">

                        <option value="null">Selecione a categoria</option>
                        
                        @foreach (App\Models\Categoria::all() as $categoria)
                            <option value="{{ $categoria->id }}">{{$categoria->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
