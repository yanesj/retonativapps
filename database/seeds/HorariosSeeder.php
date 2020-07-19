<?php

use App\Helpers\CustomProgressBar;
use App\Horario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->command->info("Truncating Horarios  Table");
		Horario::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		$data = File::get('database/data/horarios.json');
		$data = json_decode($data);
		$total = count((array) $data);
		$progress = new CustomProgressBar($this->command->getOutput()->createProgressBar($total));
		foreach ($data as $horarios) {
			 $progress->setMessage("Guardando Horarios: " . $horarios->description, 'status');
			 $horario = Horario::create([
			 	'description' => $horarios->description
			 ]);
			 $horario->save();
			 $progress->advance();
			//var_dump($countries);

		}
		$progress->finish();
		$this->command->info("\nFinished\n");
    }
}
