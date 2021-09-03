API DE FILAS COM LARAVEL

DADOS BANCO <BR />

DB_DATABASE=testevaga <BR />
DB_USERNAME=root <BR />
DB_PASSWORD= <BR />

Confi fila : 

QUEUE_CONNECTION=database <BR />

++++++++++++++++++++++++++++++++ <BR />

Rotas: 
 
/api/payments -> consulta todos pagamentos  <BR />

/api/payments/create -> cria um pagamento : segue abaixo json de teste:  <BR />

{
    "invoice" : "005888",
    "name_beneficiary" : "joao das neves",
    "cod_bank" : "123",
    "number_agence" : "0041",
    "number_count" : "001111212121212",
    "value" : "100000.00"
}
<BR />
<BR />
/api/payments/idPagamento -> consulta um pagamento através de seu id  <BR />

