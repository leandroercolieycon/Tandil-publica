<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactoMail;

use Validator;

class Contacto extends Controller
{
    private $attributeNames = [

        'nombre' => 'Nombre',
        'apellido' => 'Apellido',
        'email' => 'E-mail',
        'cod_area' => 'C&oacute;digo de &Aacute;rea',
        'celular' => 'Celular',
        'mensaje_cuerpo' => 'Cuerpo del mensaje',
    ];

    private $messages = [
            'cod_area.digits_between' => 'Debes ingresar un C&oacute;digo de &Aacute;rea v&aacute;lido.',
            'celular.digits_between' => 'Debes ingresar un C&oacute;digo de &Aacute;rea v&aacute;lido.',
        ];


    public function post(Request $request){
        $post = $request->all();

        $validator = \Validator::make($post, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'cod_area' => 'required|digits_between:2,4',
            'celular' => 'required|digits_between:6,8',
            'mensaje_cuerpo' => 'required', 
        ], $this->messages, $this->attributeNames);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if(\Mail::to($post["email"])->bcc("leandroercoli@eycon.com")->send(new ContactoMail($post["nombre"], $post["apellido"], $post["mensaje_cuerpo"]))){
            echo "<script>console.log( 'ENVIADO' );</script>";
        }else {echo "<script>console.log( 'NO ENVIADO' );</script>";}

        // check for failures
       /* if (Mail::failures()) {
            foreach(Mail::failures() as $email_address) {
                echo "<script>console.log( 'Debug Objects: " .$email_address. "' );</script>";
             }         
        }*/
    }
}
