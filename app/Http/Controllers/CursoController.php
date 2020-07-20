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

	public function viewCourses(Request $request){
		$curso = Curso::with('horarios')->paginate(10);$info=array();
		$info=array();
		foreach ($curso as $value) {
			foreach ($value['horarios'] as  $value2) {
				array_push($info,array('id'=>$value->id,'description'=>$value->nombre.' '.$value2->description,'fecha_inicio'=>$value->fecha_inicio,'fecha_fin'=>$value->fecha_fin));
			}
		}
		


		if ($request->ajax()) {
			return view('presultCourses', compact('curso','info'));
		}
		return view('viewCourses',compact('curso','info'));
	}

	public function deleteCurso(Request $request,$id){
		try {
			$curso= Curso::find($id);
			if(!$curso->estudiantes()->exists()){
				$curso->horarios()->detach();
				$curso->delete();
				return response()->json([
					'message'=>'Curso Eliminado Exitosamete',
					'class_name'=>'alert-success'
				]);	
			}
			else
			{
				return response()->json([
					'message'=>'El curso no se puede eliminar, ya tiene estudiantes asociados.',
					'class_name'=>'alert-danger'
				]);
			}
		} catch (\Illuminate\Database\QueryException $e) {


			return response()->json([
				'message'=>'El estudiante no se puede eliminar, es probable que tenga un curso asociado o haya ocurrido otro error en el proceso',
				'class_name'=>'alert-danger'
			]);

		}
	}

	public function viewDetailedCourse(Request $request,$id){
		$detailedCourse=Curso::with('horarios')->where('id',$id)->get();
		return response()->json($detailedCourse);
	}

	public function actualizarCurso(Request $request){
       $curso = Curso::find($request->id);
		$curso->nombre=$request->nombre;
		$curso->fecha_inicio=$request->fecha_inicio;
		$curso->fecha_fin=$request->fecha_fin;
		$curso->horarios()->detach();
		$curso->horarios()->attach($request->horario);

		$curso->save();
		


		return response()->json([
			'message'=>'Curso Actualizado Exitosamente',
			'class_name'=>'alert-success'
		]);

	}


}
