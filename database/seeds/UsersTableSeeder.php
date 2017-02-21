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
          'tipo_usuario_id' => 1
        ],[
          'name' => 'Admin',
          'email' => 'admin@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 1
        ],[
          'name' => 'Diamante',
          'email' => 'diamante@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 2
        ],[
          'name' => 'Platino',
          'email' => 'platino@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 3
        ],[
          'name' => 'Oros',
          'email' => 'oro@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 4
        ],[
          'name' => 'Plata',
          'email' => 'plata@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 5
        ],[
          'name' => 'Bronce',
          'email' => 'bronce@mail.com',
          'password' => bcrypt('pertennesco'),
          'duracion_de_licencia' => 0,
          'tipo_usuario_id' => 6
        ]
);
      $usuarios = array_map(function ($ar){
        $ar['duracion_de_licencia'] = $ar['tipo_usuario_id'] == 1 ? PHP_INT_MAX : 30;
        return $ar;
      }, $usuarios);

      DB::table('users')->insert($usuarios);
    }
}
