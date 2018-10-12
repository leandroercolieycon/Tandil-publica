<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\PersonalizarTarjetaMail;

use Validator;

use DB;

class Personalizar extends Controller
{


    /*  CHEQUEA EN LA BASE DE DATOS EL NUMERO DE TARJETA A PERSONALIZAR Y EL DNI EN EL PADRON.   */
    public function consultar(Request $request){

        $post = $request->all();

        $data = new \stdClass();

        $rules = [

            'nro_tarjeta' => 'required',
            'dni' => 'required|digits_between:7,8',

        ];

        $validator = \Validator::make($post, $rules, [], []);

        if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);

        } else {

            $result = DB::select("CALL sp_init_personalizacion('{$post["nro_tarjeta"]}', '{$post["dni"]}')");

            $data->estado = 0;

            foreach ($result as $row) {
                $data->estado = $row->resultado;
            }

            if($data->estado == 0){

                $result = DB::select("CALL sp_query_padron('{$post["dni"]}')");

                foreach ($result as $row) {
                    
                    if($row->dni > 0){

                        $data->nombre = $row->nombre;
                        $data->apellido = $row->apellido;
                        $data->direccion = $row->direccion;
                        $data->estado = 6;

                    } else 

                        $data->estado = 7;
                }
            }

            return json_encode($data);

        }

    }

    /*   REGISTRA LOS DATOS DEL USUARIO QUE SOLICITO PERSONALIZAR SU TARJETA.   */
    public function registrar(Request $request){

        $post = $request->all();

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'fecha_nac' =>'required|date_format:d-m-Y',
            'cod_area' => 'required|digits:3',
            'telefono' => 'required|digits:7',
            'email' => 'required|email'
        ];

        $validator = \Validator::make($post, $rules, [], []);

        if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);

        } else {

            $post["fecha_nac"] = implode('-',array_reverse(explode('-',$post["fecha_nac"])));

            $date = new \DateTime();
            $date = $date->format('Y-m-d H:i:s');

            $hash = md5( $post["dni"] + (float)$date );
            $hash = preg_replace("/[\'\¿\|\°\!\"\#\$\%\&\/\(\)\=\?\¡\¨\*\[\]\;\:\_\{\}\´\+\,\.\-\/\*\-\+ ]+/", '', $hash);          
            $random_code = rand(10000,99999);

            $ip = $request->ip();

            $data = new \stdClass();

            $result = DB::select("CALL sp_update_personalizacion(
                '{$post["nro_tarjeta"]}',
                '{$post["apellido"]}',
                '{$post["nombre"]}',
                '{$post["dni"]}',
                '{$post["direccion"]}',
                '{$post["telefono_completo"]}',
                '{$post["email"]}',
                '{$post["fecha_nac"]}',
                '{$hash}',
                '{$ip}',
                '{$post["padron"]}',
                '{$random_code}')");

            foreach ($result as $row) {
                
                $data->estado = $row->resultado;
            }

            if($data->estado == 1){

                //Envia un mail al usuario recientemente registrado
                $this->enviar_email($post["nombre"], $post["email"], $hash);

                $data->hash = $hash;
                $data->code = $random_code;
                $data->telefono = $post["telefono_completo"];
                $data->nombre = $post["nombre"];
                $data->email = $post["email"];
                
            }

            else

                $data->estado = 3;

            return json_encode($data);

        }
    }

    public function datos_enviados(Request $request){

        return view('personalizacion.datos_enviados');

    }


    /*    ENVIA UN MAIL PARA VALIDAR EL USUARIO RECIENTEMENTE REGISTRADO.   */
    public function enviar_email($nombre, $email, $hash){

        $url = 'http://localhost/tandil_public/public/personalizar/confirmar/'.$hash;
        
        $data = [ 'nombre' =>$nombre, 'url' => $url ];

        \Mail::to($email)->send(new PersonalizarTarjetaMail($data));

    }


    public function confirmar($hash = null){

        if ($hash == null)
            
            return view('registro_error', ['titulo' => 'Codigo invalido.', 
                'mensaje' => 'El codigo proporcionado no es v&aacute;lido. Verifique su casilla de e-mail.']);

        else {

            $result = DB::connection("mysql2")->select("CALL web_auv_getNombreEstado('{$hash}')");

            $existe = null; $estado = 0;

            foreach ($result as $row) {

                $existe = $row->nombre;
                $estado = $row->estado;

            }

            if ($existe != null) {

                if ($estado == 0)

                    return view('registro_correcto', ['hash' => $hash]);

                else

                    return view('registro_error', ['titulo' => 'Ya se encuentra registrado.', 
                        'mensaje' => 'Ya existe un perfil con los datos proporcionados. Si necesita recuperarlos, ponganse en contacto a traves del sitio web.']);
                
            } else

                return view('registro_error', ['titulo' => 'Datos Incompletos.', 
                    'mensaje' => 'Debe registrarse en el sistema completando todos los campos.']);

        }

    }


    public function verificar_code(Request $request){

        $post = $request->all();

        $result = DB::connection("mysql2")->select("CALL web_auv_consultaCode_v2('{$post["code"]}', '{$post["hash"]}')");

        $estado = 0;

        foreach ($result as $row) {
            
            $estado = $row->encontre;
        }

        return $estado;

    }


    public function log_error(Request $request){


    }

}
