<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use DB;

class CargarSaldo extends Controller
{

    public function post(Request $request){
        $post = $request->all();

        $validator = \Validator::make($post, [

            'tarjeta' => 'required',
            'email' => 'required|email',
            'importe' => 'required',
        ],
        [
            'tarjeta' => 'Tarjeta',
            'email' => 'E-mail',
            'importe' => 'Importe',
        ]);

        
        if($validator->fails()){

            return response()->json(['errors'=>$validator->errors()->all()]);
        }
    }

}
