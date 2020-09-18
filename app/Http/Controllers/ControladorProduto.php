<?php

namespace App\Http\Controllers;

use App\Models\Categoria as ModelsCategoria;
use App\Models\Produto as ModelsProduto;
use Illuminate\Http\Request;

class ControladorProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        return view('produtos');
    }

    public function index()
    {
        //returno do dados para a API
        $prods = ModelsProduto::all();
       
        return $prods->toJson();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novoproduto');//retornar a view com o formulario para cadastro de produtos
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prods = new ModelsProduto();
        $prods ->name = $request->input('nomeProduto');
        $prods ->stock = $request->input('estoqueProduto');
        $prods ->price = $request->input('precoProduto');
        $prods ->categoria_id = $request->input('categoriaProduto');

        $prods -> save();
        return redirect('/produtos');
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
        $prods = ModelsProduto::find($id);
        if(isset($prods)){
            return view('editarprodutos', compact('prods'));
        }
        redirect('/produtos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
