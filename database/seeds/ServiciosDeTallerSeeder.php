<?php

use Illuminate\Database\Seeder;

class ServiciosDeTallerSeeder extends Seeder
{
    protected $datos = [
        ['nombre' => 'Prueba visual', 'user_id' => 1],
        ['nombre' => 'Cilindro rechazado', 'user_id' => 1],
        ['nombre' => 'Prueba hidráulica', 'user_id' => 1],
        ['nombre' => 'Ph completo', 'user_id' => 1],
        ['nombre' => 'Revisión parcial sin Ph', 'user_id' => 1],
        ['nombre' => 'Revisión completa con pintura', 'user_id' => 1]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios_de_talleres')->insert($this->datos);
    }
}
