<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Estudiante;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


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

    //para ver estudiantes en forma detallada y general

	public function viewStudent(Request $request){
		$students = DB::table('estudiantes')
		->select('id','nombre','apellido','edad','email')->orderByRaw('nombre')->orderByRaw('apellido')
		->paginate(10);
		if ($request->ajax()) {
			return view('presultStudents', compact('students'));
		}
		return view('viewStudent',compact('students'));
	}


	public function viewDetailedStudent(Request $request,$id){
		$detailedStudent=Estudiante::where('id',$id)->get();
		return response()->json($detailedStudent);
	}

	public function actualizarEstudiante(Request $request){
		$estudiante = Estudiante::find($request->id);
		$estudiante->nombre=$request->nombre;
		$estudiante->apellido=$request->apellido;
		$estudiante->edad=$request->edad;
		$estudiante->email=$request->email;
		$estudiante->save();
		return response()->json([
			'message'=>'Estudiante Actualizado Exitosamente',
			'class_name'=>'alert-success'
		]);

	}

	public function deleteEstudiante(Request $request,$id){
		try {
				$estudiante = Estudiante::find($id);
				$estudiante->delete();
				return response()->json([
					'message'=>'Estudiante Eliminado Exitosamete',
					'class_name'=>'alert-success'
				]);

		} catch (\Illuminate\Database\QueryException $e) {


			return response()->json([
				'message'=>'El estudiante no se puede eliminar, es probable que tenga un curso asociado o haya ocurrido otro error en el proceso',
				'class_name'=>'alert-danger'
			]);

		}
	}
	
}
