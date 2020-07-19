<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use Illuminate\Support\Facades\Auth;
use Validator;

class CursoController extends Controller
{
   public function index(){
		return view('curso');
	}

	public function registrarCurso(Request $request){
		$validation = Validator::make($request->all(),[
			'nombre'=>'required',
			'horario'=>'required',
			'fecha_inicio'=>'required',
			'fecha_fin'=>'required'
		]);

		if($validation->passes()){
			$curso = Curso::create([
			 	'nombre' => $request->nombre,
			  	'fecha_inicio' => $request->fecha_inicio,
			 	'fecha_fin' => $request->fecha_fin
			 ]);
			 
             $curso->horarios()->attach([$request->horario]);
			 $curso->save();

			return response()->json([
				'message'=>'Curso Creado Exitosamente',
				'class_name'=>'alert-success'
			]);
			

		}
		else{
			return response()->json([
				'message'=>$validation->errors()->all(),
				'class_name'=>'alert-danger'
			]);
		}
	}

	
}
