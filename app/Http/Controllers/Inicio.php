<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use DB;

class Inicio extends Controller
{   
 
    public function index(){                
    	return view('inicio');
    }
    
    public function get_prk(Request $request){
        $prk = DB::connection("mysql_db_prod")->select("CALL sp_webpublic_get_prk()");
        return $prk;
    }

    public function get_pv(Request $request){
        $pv = DB::connection("mysql_db_prod")->select("CALL sp_webpublic_get_pv()");
        return $pv;
    }
}
