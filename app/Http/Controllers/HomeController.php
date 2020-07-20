<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Curso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cursos = DB::select('SELECT cursos.nombre AS materia,COUNT(estudiantes.nombre) AS cant_estud 
        FROM cursos 
        JOIN curso_estudiante ON(cursos.id=curso_estudiante.curso_id)
        JOIN estudiantes ON(curso_estudiante.estudiante_id=estudiantes.id)
        WHERE curso_estudiante.`created_at`>=DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
        GROUP BY cursos.nombre ORDER BY COUNT(estudiantes.nombre) DESC LIMIT 3');
        return view('home', compact('cursos'));
    }

    public function getObject(Request $request){
        $estudiantes = DB::select('SELECT COUNT(estudiantes.id) AS num_estud,cursos.`nombre` AS curso,MONTHNAME(curso_estudiante.`created_at`) AS mes_inscrip
 FROM estudiantes 
JOIN curso_estudiante ON (estudiantes.id=curso_estudiante.estudiante_id)
JOIN cursos ON (cursos.id=curso_estudiante.`curso_id`) 
GROUP BY MONTHNAME(curso_estudiante.`created_at`),cursos.`nombre`');

  $meses= DB::select('SELECT MONTHNAME(curso_estudiante.`created_at`) AS mes_inscrip
 FROM estudiantes 
JOIN curso_estudiante ON (estudiantes.id=curso_estudiante.estudiante_id)
JOIN cursos ON (cursos.id=curso_estudiante.`curso_id`) 
GROUP BY MONTHNAME(curso_estudiante.`created_at`) ORDER BY curso_estudiante.`created_at` ASC');

  $cursos= DB::select('SELECT cursos.nombre AS curso
 FROM estudiantes 
JOIN curso_estudiante ON (estudiantes.id=curso_estudiante.estudiante_id)
JOIN cursos ON (cursos.id=curso_estudiante.`curso_id`) 
GROUP BY cursos.nombre');

$x=array();
  $labels=[];
  $datasets=[];
 // $labels=['January', 'February', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
 foreach ($meses as $value) {
            array_push($labels,$value->mes_inscrip);
        } 

 foreach ($cursos as  $value) {
    $x=array('label'=>$value->curso,'backgroundColor'=>'color(window.chartColors.red).alpha(0.5).rgbString()',
        'borderColor'=>'window.chartColors.red',
        'borderWidth'=> '1');
    array_push($datasets,$x);
 }             

  
  $x=array('labels'=>$labels,'datasets'=>$datasets);
 
  printf(json_encode($x));

       // return response()->json($estudiantes);
    }

    public function getCoursesWithMoreStudents(Request $request){
     
     return response()->json($cursos);
 }


}
