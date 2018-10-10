<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SolicitarTarjetaMail;

use Validator;

use DB;

class SolicitarTarjeta extends Controller
{

    public function post(Request $request){

    	$post = $request->all();

    	$rules = array();

    	$attributeNames = array();

        if($post['tipo_solicitud'] == 0){

        	$rules = [

        		'nombre' => 'required',
        		'apellido' => 'required',
        		'dni' => 'required|digits_between:7,8'

        	];

        } else {

        	$rules = [

        		'razon_social' => 'required',
        		'cuit' => 'required|size:15' 

        	];

        }


    	$rules += [

            'email' => 'email|same:email_repeat',
            'email_repeat' => 'email',
            'cod_area' => 'required|digits_between:3,4',
            'telefono' => 'required|digits:7'

        ];


        if($post['tipo_patente'] == 0)

            $rules += ['patente' => 'required|size:6'];

        else

            $rules += ['patente' => 'required|size:8'];


        $validator = \Validator::make($post, $rules, [], []);

    	
    	if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);

        } else {

            if(DB::select("CALL web_solicitud_tarjetas_validar_usuario('{$post["dni"]}')"))

                return "error_dni";

            else{

                if(DB::select("CALL web_solicitud_tarjetas_validar_patente('{$post["patente"]}')"))

                    return "error_patente";

                else{

                    $cargarDatos = DB::select("CALL web_solicitud_tarjetas_cargarDatos('{$post["nombre"]}','{$post["apellido"]}','{$post["email"]}','{$post["dni"]}','{$post["cod_area"]}','{$post["telefono"]}','{$post["telefono_completo"]}','{$post["patente"]}','{$post["tipo_solicitud"]}')");

                    $estado = "exito";

                    foreach ($cargarDatos as $fila) {
                        if ($fila->status == 0){
                            $estado = "error_db";
                            break;
                        }
                    }

                    if($estado == "exito")
                        \Mail::to($post['email'])->send(new SolicitarTarjetaMail($post["nombre"]));

                    return $estado;

                }
            }

        }

    }


    public function log_error(Request $request){

        //Metodo que recibe un status de error y los datos enviados. Para posible envio de mail a los desarrolladores.

    }
}
