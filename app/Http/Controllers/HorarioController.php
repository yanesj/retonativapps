<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;

class HorarioController extends Controller
{
     public function getHorarios(Request $request){
    	$horario = Horario::all()->sortBy('description');
      	$info= array();
    	foreach ($horario as $value) {
    		array_push($info,array('id'=>$value->id,'description'=>$value->description));
    	}
    	return response()->json($info);

    }
}
