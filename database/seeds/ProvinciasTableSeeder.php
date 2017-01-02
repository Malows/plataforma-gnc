<?php

use Illuminate\Database\Seeder;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     protected $provs = [
       ['nombre' =>'Buenos Aires'],['nombre' =>'Capital Federal'],
       ['nombre' =>'Catamarca'],['nombre' =>'Chaco'],
       ['nombre' =>'Chubut'],['nombre' => 'Córdoba'],
       ['nombre' =>'Corrientes'],['nombre' =>'Entre Ríos'],
       ['nombre' =>'Formosa'],['nombre' =>'Jujuy'],
       ['nombre' =>'La Pampa'],['nombre' => 'La Rioja'],
       ['nombre' =>'Mendoza'],['nombre' =>'Misiones'],
       ['nombre' =>'Neuquén'],['nombre' =>'Río Negro'],
       ['nombre' =>'Salta'],['nombre' => 'San Juan'],
       ['nombre' =>'San Luis'],['nombre' =>'Santa Cruz'],
       ['nombre' =>'Santa Fé'],['nombre' =>'Santiago del Estero'],
       ['nombre' => 'Tierra del Fuego'],['nombre' =>'Tucumán']];

    public function run()
    {
        DB::table('provincias')->insert($this->provs);
    }
}
