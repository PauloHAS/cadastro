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
                    <th>Categoria</th>
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

    <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
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
                        <button type="cancel" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        function novoProduto() {
            //limpar campos do modal caso sai sem cancelar ou confirmar

            $('#nomeProduto').val('')
            $('#estoqueProduto').val('')
            $('#precoProduto').val('')
            $('#categoriaProduto').val('')

            $('#dlgProdutos').modal('show')
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

        function montarLinha(p) { //escrever os produtos na view
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.name + "</td>" +
                "<td>" + p.stock + "</td>" +
                "<td>" + p.price + "</td>" +
                "<td>" + p.categoria_id + "</td>" +
                "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')">Editar</button>' +
                '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')">Apagar</button>' +
                "</td>" +
                "</tr>";

            return linha;
        }

        function remover(id) { //função ajax para remoção de produtos
            $.ajax({
                type: "DELETE",
                url: "/api/produtos/" + id,
                context: this,

                success: function() { //removendo as linhas da tabela view produto sem precisar atualizar a página
                    console.log("Apagado com sucesso");

                    linhas = $('#tabelaProdutos>tbody>tr')

                    e = linhas.filter(function(i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e) {
                        e.remove();
                    }
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }

        function carregarProdutos() { //trazer a relação de produtos para a tela
            $.getJSON('/api/produtos', function(produtos) {

                for (i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $("#tabelaProdutos>tbody").append(linha);

                }
            });
        }

        function criarProduto() { //função para criar um novo produto no banco de de dados
            prods = { // criação do objeto
                nome: $('#nomeProduto').val(),
                estoque: $('#estoqueProduto').val(),
                preco: $('#precoProduto').val(),
                categoria_id: $('#categoriaProduto').val()
            };

            $.post('api/produtos', prods, function(
                data) { //função para salvar e atualizar os dados no navegador sem dar um refresh na pagina
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $("#tabelaProdutos>tbody").append(linha);
            })
        }

        $('#formProduto').submit(function(event) {
            event.preventDefault();
            criarProduto();
            $("#dlgProdutos").modal('hide'); // fechar o modal do cadastro após clicar em salvar
        });

        //função json para carregar os dados assim que a pagina for carregada
        $(function() {
            carregarCategorias();
            carregarProdutos();
        });

    </script>
@endsection
