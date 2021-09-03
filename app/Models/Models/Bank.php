<?php

namespace App\Models\Models;

use App\Jobs\processaPagamentos;
use App\Jobs\consultaStatusPagamentos;
use App\Jobs\atualizaStatusAposProcessamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bank extends Model
{
    use HasFactory;

    public function registraPagamento(Request $request)
    {
        $request->validate([
            'invoice' => ['required','numeric', 'unique:payments,invoice'],
            'name_beneficiary' => 'required',
            'cod_bank' => ['required', 'numeric', 'digits_between:1,3'],
            'number_agence' => ['required', 'numeric','digits_between:1,4'],
            'number_count' => ['required', 'numeric', 'digits_between:1,15'],
            'value' => ['required', 'numeric', 'between:0.01,100000']
        ]);

        $dados = $request->all();
        $dados['status'] = 'CRIADO';

        $id = Payment::create($dados)->id;

        processaPagamentos::dispatch($id)->delay(now());
    }

    public static function consultaPagamento($id)
    {
        
        if(Payment::find($id) == null)
        {
            return ["Pagamento nao localizado"];
        }else
        {
            return Payment::find($id);
        }
    }

    public static function processaPagamento($id)
    {
        $dadosPagamento['bank_process'] = ($id % 2 == 0)? "002_BANCO_BRASIL" : "001_CAIXA";
        $dadosPagamento['status'] = "PROCESSANDO";
         
        Payment::findOrfail($id)->update($dadosPagamento);
        consultaStatusPagamentos::dispatch($id)->delay(now()->addMilliseconds('1'));
    }

    public static function consultaStatusPagamento($id)
    {
        $dadosPagamento['status'] = "PROCESSADO";    
        Payment::findOrfail($id)->update($dadosPagamento);
        atualizaStatusAposProcessamento::dispatch($id)->delay(now()->addSeconds('120'));
    }

    public static function atualizaStatusAposProcessamento($id)
    {
        $dadosPagamento['status'] = now()->getPreciseTimestamp() % 2 == 0 ? "PAGO" : "REJEITADO";    
        Payment::findOrfail($id)->update($dadosPagamento);
    }
}
