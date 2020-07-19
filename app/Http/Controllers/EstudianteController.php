<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Estudiante;
use Illuminate\Support\Facades\Auth;
use Validator;


class EstudianteController extends Controller
{
	public function index(){
		return view('estudiante');
	}

	public function registrarEstudiante(Request $request){
		$validation = Validator::make($request->all(),[
			'nombre'=>'required',
			'apellido'=>'required',
			'edad'=>'required',
			'email'=>'required|unique:estudiantes'
		]);

		if($validation->passes()){
			$estudiante = Estudiante::create([
			 	'nombre' => $request->nombre,
			 	'apellido' => $request->apellido,
			 	'edad' => $request->edad,
			 	'email' => $request->email
			 ]);
			 $estudiante->save();
			return response()->json([
				'message'=>'Estudiante Creado Exitosamente',
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

	public function getEstudiante(Request $request){
    	$estudiante = Estudiante::all()->sortBy('nombre')->sortBy('apellido');
      	$info= array();
    	foreach ($estudiante as $value) {
    		array_push($info,array('id'=>$value->id,'description'=>$value->nombre.' '.$value->apellido));
    	}
    	return response()->json($info);

    }
}
