<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //por segurança navegadores restringem requisições -> ao utilizar em aplicativos ou navegadores as requisições serão liberadas
    public function __construct(){
        header('Access-Controll-Allow-Origin: *');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return response()->json(['data' => $produtos, 'status'=>true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $produto = Produto::create($dados);
        if($produto){
            return response()->json(['data'=>$produto, 'status'=>true]);
        }else{
            return response()->json(['data'=>'Erro ao criar produto', 'status'=>false]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if($produto){
            return response()->json(['data' => $produto, 'status' => true]);
        }else{
            return response()->json(['data' => 'Produto não foi encontrado!', 'status' => false]);
        }
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
        $dados = $request->all();
        $produto = Produto::find($id);
        if($produto){
            $produto->update($dados);
            return response()->json(['data' => $produto, 'status' => true]);
        }else{
            return response()->json(['data' => 'Erro ao editar produto', 'status' => false]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        if($produto){
            $produto->delete();
            return response()->json(['data' => 'Produto removido com sucesso', 'status' => true]);
        }else{
            return response()->json(['data' => 'Não foi possível remover o produto', 'status' => false]);
        }
    }
}
