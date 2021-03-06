<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Payment;
use App\Models\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objRetorno = Payment::all();
        if(Payment::all()->count() == 0)
        {
            return ['nenhum pagamento encontrado'];
        }else
        {
            return $objRetorno;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank = new Bank();
        $bank->registraPagamento($request);
        return ["sucess" =>"pagamento criado com sucesso"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Bank::consultaPagamento($id);
    }

}
