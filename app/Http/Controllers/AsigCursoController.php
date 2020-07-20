<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Estudiante;
use Validator;

class AsigCursoController extends Controller
{
	public function index(){
		return view('asigCurso');
	}

	public function getCursos(){
		$curso = Curso::with('horarios')->get();
		$info=array();
		foreach ($curso as $value) {
			foreach ($value['horarios'] as  $value2) {
				array_push($info,array('id'=>$value->id,'description'=>$value->nombre.' '.$value2->description));
			}
		}
		return response()->json($info);

	}
	public function asigCursoEstudiante(Request $request){
		$validation = Validator::make($request->all(),[
			'curso_id'=>'required',
			'estudiante_id'=>'required',
		]);

		if($validation->passes()){
			
			try {
				$date = date('Y-m-d H:i:s');
				$estudiante= Estudiante::find($request->estudiante_id);
				$estudiante->cursos()->attach($request->curso_id,['created_at' => $date = date('Y-m-d H:i:s')]);
				return response()->json([
					'message'=>'Curso Asignado Exitosamente',
					'class_name'=>'alert-success'
				]);

			} catch (\Illuminate\Database\QueryException $e) {
				

				return response()->json([
					'message'=>'Error en el proceso de inserción en la base de datos,Verifique la información a insertar.',
					'class_name'=>'alert-danger'
				]);

			}

		}
		else{
			return response()->json([
				'message'=>$validation->errors()->all(),
				'class_name'=>'alert-danger'
			]);
		}

	}



	


}
