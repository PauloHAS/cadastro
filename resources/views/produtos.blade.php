@extends('layouts.app', ["current" => "produtos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>

            <table class="table table-sm table-hover table-bordered" id="tabelaProdutos">
                <thead>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Departamento</th>
                    <th>Opções</th>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novoProduto()">Novo Produto</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgprodutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Produto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" placeholder="nome">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="estoqueProduto" class="control-label">Estoque</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="estoqueProduto" placeholder="estoque">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precoProduto" placeholder="preco">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categorias</label>
                            <div class="input-group">
                                <select class="form-control" id="categoriaProduto">
                                    <option selected value="">Selecione a categoria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <button type="cancel" class="btn btn-secondary btn-sm" data-dissmiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function novoProduto() {
            //limpar campos do modal caso sai sem cancelar ou confirmar

            $('#nomeProduto').val('')
            $('#estoqueProduto').val('')
            $('#precoProduto').val('')
            $('#categoriaProduto').val('')

            $('#dlgprodutos').modal('show')
        }

        //funcao para carregar os dados de categoria
        function carregarCategorias() {
            $.getJSON('/api/categorias', function(data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' + data[i].name + '</option>';
                    $('#categoriaProduto').append(opcao);
                }
            });
        }

        function montarLinha(p) {
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.name + "</td>" +
                "<td>" + p.stock + "</td>" +
                "<td>" + p.price + "</td>" +
                "<td>" + p.categoria_id + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary">Editar</button>' +
                '<button class="btn btn-sm btn-danger">Apagar</button>' +
                "</td>" +
                "</tr>"

                return linha;
        }

        function carregarProdutos() {
            $.getJSON('/api/produtos', function(produtos) {

                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $("#tabelaProdutos>tbody").append(linha);

                }
            });
        }

        //função json para carregar os dados assim que a pagina for carregada
        $(function() {
            carregarCategorias();
            carregarProdutos();
        });

    </script>
@endsection
