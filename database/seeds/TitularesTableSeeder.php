<?php

use Illuminate\Database\Seeder;
use App\Titular;

class TitularesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Titular::class, 20)->create();
    }
}
