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
        $prods ->name = $request->input('nome');
        $prods ->stock = $request->input('estoque');
        $prods ->price = $request->input('preco');
        $prods ->categoria_id = $request->input('categoria_id');

        $prods -> save();
        return json_encode($prods);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//mostrando um produto especifico
    {
        $prods = ModelsProduto::find($id);
        if(isset($prods)){

            return json_encode($prods);
        }
        return response('Produto não encontrado!', 404);
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
        $prods = ModelsProduto::find($id);
        if($prods){

            $prods ->name = $request->input('nome');
            $prods ->stock = $request->input('estoque');
            $prods ->price = $request->input('preco');
            $prods ->categoria_id = $request->input('categoria_id');
    
            $prods -> save();
            return json_encode($prods);
        }
        return response('Produto não encontrado!', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prods = ModelsProduto::find($id);
        if(isset($prods)){
            $prods -> delete();
            return response('Ok', 200);
        }
        return response('Produto Não encontrado!', 404);
    }
}
