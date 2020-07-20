<?php
namespace App\Traits;
use Illuminate\Http\Request;
use DB;
use App\Curso;

trait getObject{
	public function getObject(){
        //Cantidad de estudiantes por curso por mes
		$estudiantes = DB::select("SELECT curso,GROUP_CONCAT(mes_inscrip,'-',num_estud) AS finaldata FROM cantesttot  GROUP BY curso");
        //Los meses para pasarlos al los lables del gráfico
		$meses= DB::select('SELECT MONTHNAME(curso_estudiante.`created_at`) AS mes_inscrip
			FROM estudiantes 
			JOIN curso_estudiante ON (estudiantes.id=curso_estudiante.estudiante_id)
			JOIN cursos ON (cursos.id=curso_estudiante.`curso_id`) 
			GROUP BY MONTHNAME(curso_estudiante.`created_at`) ORDER BY curso_estudiante.`created_at` ASC');
        //los cursos registrados para que salgan en el gráfico
		$cursos= DB::select('SELECT cursos.nombre AS curso
			FROM estudiantes 
			JOIN curso_estudiante ON (estudiantes.id=curso_estudiante.estudiante_id)
			JOIN cursos ON (cursos.id=curso_estudiante.`curso_id`) 
			GROUP BY cursos.nombre ');

		$x=array();
		$labels=[];
		$datasets=[];
		$data=[0,0,0,0,0,0,0,0,0,0,0,0];


		foreach ($estudiantes as  $value1) {
			$step1=$value1->finaldata;
			$step2= explode(',',$step1);
			foreach ($step2 as $value) {
				$step3= explode('-',$value);
				$data[$step3[0]-1]=intval($step3[1]); 
			}
			$x=array('label'=>$value1->curso,'backgroundColor'=>'color(window.chartColors.red).alpha(0.5).rgbString()',
				'borderColor'=>'window.chartColors.red',
				'borderWidth'=> 1,'data'=>$data);
			array_push($datasets,$x);


		}


		foreach ($meses as $value) {
			array_push($labels,$value->mes_inscrip);
		} 
		$x=array('labels'=>$labels,'datasets'=>$datasets);





       return json_encode($x);
	}
}
?>