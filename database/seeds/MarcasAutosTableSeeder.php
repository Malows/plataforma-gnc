<?php

use Illuminate\Database\Seeder;

class MarcasAutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     protected $datos = [
       ['nombre' => "Acura"], ['nombre' => "Alfa Romeo"], ['nombre' => "Aptera"],
       ['nombre' => "Aston Martin"], ['nombre' => "Audi"], ['nombre' => "Austin"],
       ['nombre' => "Bentley"], ['nombre' => "BMW"], ['nombre' => "Bugatti"],
       ['nombre' => "Buick"], ['nombre' => "Cadillac"], ['nombre' => "Cherry"],
       ['nombre' => "Chevrolet"], ['nombre' => "Chrysler"], ['nombre' => "Citroën"],
       ['nombre' => "Corbin"], ['nombre' => "Daewoo"], ['nombre' => "Daihatsu"],
       ['nombre' => "Dodge"], ['nombre' => "Eagle"], ['nombre' => "Fairthorpe"],
       ['nombre' => "Ferrari"], ['nombre' => "FIAT"], ['nombre' => "Fillmore"],
       ['nombre' => "Foose"], ['nombre' => "Ford"], ['nombre' => "Geo"],
       ['nombre' => "GMC"], ['nombre' => "Hillman"], ['nombre' => "Holden"],
       ['nombre' => "Honda"], ['nombre' => "HUMMER"], ['nombre' => "Hyundai"],
       ['nombre' => "Infiniti"], ['nombre' => "Isuzu"], ['nombre' => "Jaguar"],
       ['nombre' => "Jeep"], ['nombre' => "Jensen"], ['nombre' => "Kia"],
       ['nombre' => "Lamborghini"], ['nombre' => "Land Rover"], ['nombre' => "Lexus"],
       ['nombre' => "Lincoln"], ['nombre' => "Lotus"], ['nombre' => "Maserati"],
       ['nombre' => "Maybach"], ['nombre' => "Mazda"], ['nombre' => "McLaren"],
       ['nombre' => "Mercedes-Benz"], ['nombre' => "Mercury"], ['nombre' => "Merkur"],
       ['nombre' => "MG"], ['nombre' => "MINI"], ['nombre' => "Mitsubishi"],
       ['nombre' => "Morgan"], ['nombre' => "Nissan"], ['nombre' => "Oldsmobile"],
       ['nombre' => "Panoz"], ['nombre' => "Peugeot"], ['nombre' => "Plymouth"],
       ['nombre' => "Pontiac"], ['nombre' => "Porsche"], ['nombre' => "Ram"],
       ['nombre' => "Rambler"], ['nombre' => "Renault"], ['nombre' => "Rolls-Royce"],
       ['nombre' => "Saab"], ['nombre' => "Saturn"], ['nombre' => "Scion"],
       ['nombre' => "Shelby"], ['nombre' => "Smart"], ['nombre' => "Spyker"],
       ['nombre' => "Spyker Cars"], ['nombre' => "Studebaker"], ['nombre' => "Subaru"],
       ['nombre' => "Suzuki"], ['nombre' => "Tesla"], ['nombre' => "Toyota"],
       ['nombre' => "Volkswagen"], ['nombre' => "Volvo" ]];

     public function run()
     {
         DB::table('marcas_autos')->insert($this->datos);
     }
 }
