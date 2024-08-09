<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('car_companies')->insert([
            ['name' => 'Toyota'],
            ['name' => 'Honda'],
            ['name' => 'Ford'],
            ['name' => 'BMW'],
            ['name' => 'Mercedes-Benz'],
            ['name' => 'Audi'],
            ['name' => 'Volkswagen'],
            ['name' => 'Hyundai'],
            ['name' => 'Nissan'],
            ['name' => 'Chevrolet'],
            ['name' => 'Porsche'],
            ['name' => 'Mazda'],
            ['name' => 'Subaru'],
            ['name' => 'Jaguar'],
            ['name' => 'Kia'],
            ['name' => 'Mitsubishi'],
            ['name' => 'Land Rover'],
            ['name' => 'Peugeot'],
            ['name' => 'Citroën'],
            ['name' => 'Volvo'],
            ['name' => 'Tesla'],
            ['name' => 'Lexus'],
            ['name' => 'Ferrari'],
            ['name' => 'Lamborghini'],
            ['name' => 'Aston Martin'],
            ['name' => 'Bentley'],
            ['name' => 'Rolls-Royce'],
            ['name' => 'Maserati'],
            ['name' => 'Alfa Romeo'],
            ['name' => 'Bugatti'],
            ['name' => 'Mini'],
            ['name' => 'Fiat'],
            ['name' => 'Jeep'],
            ['name' => 'Dodge'],
            ['name' => 'Chrysler'],
            ['name' => 'Ram'],
            ['name' => 'Acura'],
            ['name' => 'Infiniti'],
            ['name' => 'Genesis'],
            ['name' => 'Lincoln'],
            ['name' => 'Buick'],
            ['name' => 'Cadillac'],
            ['name' => 'GMC'],
            ['name' => 'Suzuki'],
            ['name' => 'Saab'],
            ['name' => 'Skoda'],
            ['name' => 'Renault'],
            ['name' => 'SEAT'],
            ['name' => 'Opel'],
            ['name' => 'Dacia'],
            ['name' => 'Lancia'],
        ]);
        
    }
}
