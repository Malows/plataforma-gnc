<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvinciasTableSeeder::class);
        $this->call(TiposUsariosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MarcasAutosTableSeeder::class);
        $this->call(LocalidadesTableSeeder::class);
        $this->call(ModelosAutosTableSeeder::class);
        $this->call(ServiciosDeTallerSeeder::class);
        $this->call(TitularesTableSeeder::class);
        $this->call(VehiculosTableSeeder::class);
        $this->call(ServiciosDeTallerSeeder::class);
        $this->call(MarcasDeCilindrosSeeder::class);
    }
}
