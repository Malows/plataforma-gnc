<?php

use Illuminate\Database\Seeder;

class LocalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(LocalidadesTable_1_12_Seeder::class);
      $this->call(LocalidadesTable_2_12_Seeder::class);
      $this->call(LocalidadesTable_3_12_Seeder::class);
      $this->call(LocalidadesTable_4_12_Seeder::class);
      $this->call(LocalidadesTable_5_12_Seeder::class);
      $this->call(LocalidadesTable_6_12_Seeder::class);
      $this->call(LocalidadesTable_7_12_Seeder::class);
      $this->call(LocalidadesTable_8_12_Seeder::class);
      $this->call(LocalidadesTable_9_12_Seeder::class);
      $this->call(LocalidadesTable_10_12_Seeder::class);
      $this->call(LocalidadesTable_11_12_Seeder::class);
      $this->call(LocalidadesTable_12_12_Seeder::class);
    }



}
