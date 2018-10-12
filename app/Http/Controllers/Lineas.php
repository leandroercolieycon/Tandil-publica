<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use DB;

class Lineas extends Controller
{   
    public function getLineas(Request $request){
        $linea = $request->l;
        
        switch($linea){
            case "500":
                $linea = "kml_3_pa";
                break;
            case "501":
                $linea = "kml_4_pa";
                break;
            case "502":
                $linea = "kml_5_pa";
                break;
            case "503":
                $linea = "kml_6_pa";
                break;
            case "504":
                $linea = "kml_7_pa";
                break;
            case "505":
                $linea = "kml_8_pa";
				break;
			default: // DEFAULT
				break;
        }
        $buses = DB::connection("mysql_etrack")->select("select * from ". $linea ." where unidad between 1 and 13");
        return $buses;
	}
	
	public function getRecorrido(Request $request){
        $linea = $request->l;
        
        switch($linea){
            case "500":
                $empresa = "3";
                break;
            case "501":
                $empresa = "4";
                break;
            case "502":
                $empresa = "5";
                break;
            case "503":
                $empresa = "6";
                break;
            case "504":
                $empresa = "7";
                break;
            case "505":
                $empresa = "8";
				break;
			default: // DEFAULT
				break;
        }
        $recorrido = DB::connection("mysql_earth")->select("select * from recorridos where codigo_empresa = ". $empresa);
        return $recorrido;
    }   
}
