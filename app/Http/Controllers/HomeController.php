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

    public function getCoursesWithMoreStudents(Request $request){
     
     return response()->json($cursos);
 }


}
