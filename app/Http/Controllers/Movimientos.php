<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use DB;

class Movimientos extends Controller
{
    public function post(Request $request){
        // Validar el formulario
        $validator = \Validator::make($request->all(), [

            'tarjeta' => 'required'
        ],
        [
            'tarjeta' => 'Tarjeta'
        ]);
        
        if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        // Obtener datos de la DB        
        $tarjeta_valida = DB::select("CALL sp_webpublic_valid_card('{$request->tarjeta}')")[0]->valid_card;

        if($tarjeta_valida){

            // Movimientos para tres meses
            $data['movimientos'] = DB::select("CALL sp_webpublic_get_mov_3meses_prk('{$request->tarjeta}')");

            // Solicita el saldo pendiente de acreditacion de la tarjeta   
            $data['saldo_pendiente'] = DB::select("CALL sp_web_public_get_saldoAcredPend('{$request->tarjeta}')");

            return $data;

        } else

            return response()->json(['errors'=>["No se encontraron movimientos para la tarjeta. Asegúrese de haber ingresado el número de tarjeta correctamente."]]);

    }

}
