<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DebtorResource;
use App\Models\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtors = Debtor::all();
        return response([ 'debtors' => $debtors, 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:255',
            'cpf_cnpj' => 'required|numeric',
            'data_nascimento' => 'required|date',
            'endereco'=> 'required|max:500',
            'descricao_titulo'=> 'required|max:64',
            'valor'=> 'required|numeric',
            'data_vencimento' => 'required|date',
            'updated'=> 'required|max:255',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $debtor = Debtor::create($data);

        return response([ 'debtor' => new DebtorResource($debtor), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        return response([ 'debtor' => new DebtorResource($debtor), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debtor $debtor)
    {
        $debtor->update($request->all());

        return response([ 'debtor' => new DebtorResource($debtor), 'message' => 'Retrieved successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
        $debtor->delete();
        return response(['message' => 'Deleted'], 204);
    }
}
