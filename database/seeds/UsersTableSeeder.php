<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $usuarios = array(
        [
          'name' => 'Juan Manuel',
          'email' => 'cruz.jm.stafe@gmail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario' => 1
        ],[
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('admin'),
          'duracion_de_licencia' => 0,
          'tipo_usuario' => 1
        ]
      );
      $usuarios = array_map(function ($ar){
        $ar['duracion_de_licencia'] = $ar['tipo_usuario'] == 1 ? PHP_INT_MAX : 30;
        return $ar;
      }, $usuarios);

      DB::table('users')->insert($usuarios);
    }
}
