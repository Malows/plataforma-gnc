<?php

use Illuminate\Database\Seeder;

class TiposUsariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tipos = ['admin', 'diamante', 'platino', 'oro', 'plata', 'bronce'];

      foreach ($tipos as $tipo) {
        DB::table('tipos_usuarios')->insert(['nombre' => $tipo]);
      }
    }
}
