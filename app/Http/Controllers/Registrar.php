<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\RegistrarMail;

use Validator;

use DB;

class Registrar extends Controller
{

    public function post(Request $request){

        $post = $request->all();

        $rules = [

            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|digits_between:7,8',
            'cod_area' => 'required|digits_between:3,4',
            'telefono' => 'required|digits:7',
            'email' => 'email',
            'password' => 'required|min:8',
            'password_repeat' => 'bail|same:password|required|min:8',

        ];

        for ($i = 1; $i <= $post['cant_vehiculos']; $i++) {

            if ($post['tipo_patente_'.$i] == 0)

                $rules += ['patente_vehiculo_'.$i => 'required|size:6'];

            else

                $rules += ['patente_vehiculo_'.$i => 'required|size:7'];

        }

        $validator = \Validator::make($post, $rules, [], []);

        if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);

        } else {

            if(DB::connection("mysql2")->select("CALL web_auv_existeCelular_v2('{$post["telefono_completo"]}')"))
                
                return 'error_telefono';

            else {

                if(DB::connection("mysql2")->select("CALL web_auv_existeUsuario_v2('{$post["usuario"]}')"))

                    $post["usuario"] = "rep";
                

                if(DB::connection("mysql2")->select("CALL web_auv_existeMail_v2('{$post["email"]}')"))

                    return 'error_mail';

                else {

                    $nick = strtolower($post["email"]);

                    $check_hash = md5( date( 'd-m-Y H:i:s', time() ) );
                    $patron = "/[\'\¿\|\°\!\"\#\$\%\&\/\(\)\=\?\¡\¨\*\[\]\;\:\_\{\}\´\+\,\.\-\/\*\-\+ ]+/";
                    $hash = preg_replace($patron, '', $check_hash);
                    
                    $random_code = rand(10000,99999);

                    $cargarDatos = DB::connection("mysql2")->select("CALL auv_cargarDatos_v3(
                        '{$post["nombre"]}',
                        '{$post["apellido"]}',
                        '{$nick}',
                        '{$post["dni"]}',
                        '{$post["usuario"]}',
                        '{$post["password"]}',
                        '{$post["cod_area"]}',
                        '{$post["telefono"]}',
                        '{$post["telefono_completo"]}',
                        '{$hash}',
                        '{$random_code}',
                        '{$post["patente_vehiculo_1"]}',
                        '{$post["patente_vehiculo_2"]}',
                        '{$post["patente_vehiculo_3"]}',
                        '{$post["compania"]}')");

                        //Enviar SMS
                        $this->enviar_sms($post["telefono_completo"], $random_code);
                        
                        //Enviar Mail
                        $this->enviar_email($post["nombre"], $nick, $check_hash); 

                    return 'exito';

                }
            }
        }

    }


    public function enviar_sms($telefono, $random_code){
        
        $url = 'http://ip-172-31-63-135.ec2.internal/sms/'.'+54'.$telefono.'/'.$random_code;
        
        $ch = curl_init();  
 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        $output=curl_exec($ch);
        $error = curl_error($ch);
 
        curl_close($ch);
        
    }
    
    
    public function enviar_email($nombre, $email, $check_hash){

        $url = 'http://localhost/larioja/public/registrar/confirmar/'.$check_hash;
        
        $data = [ 'nombre' =>$nombre, 'url' => $url ];

        \Mail::to($email)->send(new RegistrarMail($data));

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
