<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            1 => ['Corolla', 'Camry', 'RAV4', 'Prius', 'Highlander', 'Land Cruiser', 'Yaris'],
            2 => ['Civic', 'Accord', 'CR-V', 'Fit', 'Pilot', 'Odyssey', 'Ridgeline'],
            3 => ['F-150', 'Mustang', 'Explorer', 'Escape', 'Focus', 'Fusion', 'Bronco'],
            4 => ['3 Series', '5 Series', 'X5', 'X3', 'M3', '7 Series', 'Z4'],
            5 => ['C-Class', 'E-Class', 'S-Class', 'GLE', 'GLC', 'A-Class', 'AMG GT'],
            6 => ['A4', 'A6', 'Q5', 'Q7', 'TT', 'A3', 'R8'],
            7 => ['Golf', 'Passat', 'Tiguan', 'Jetta', 'Atlas', 'Beetle', 'Touareg'],
            8 => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Kona', 'Palisade', 'Veloster'],
            9 => ['Altima', 'Sentra', 'Maxima', 'Rogue', 'Pathfinder', 'Murano', '370Z'],
            10 => ['Silverado', 'Malibu', 'Equinox', 'Camaro', 'Tahoe', 'Impala', 'Traverse'],
            11 => ['911', 'Cayenne', 'Macan', 'Panamera', 'Boxster', 'Taycan', '718 Cayman'],
            12 => ['Mazda3', 'Mazda6', 'CX-5', 'CX-3', 'CX-9', 'MX-5 Miata', 'CX-30'],
            13 => ['Impreza', 'Legacy', 'Outback', 'Forester', 'Crosstrek', 'BRZ', 'Ascent'],
            14 => ['XE', 'XF', 'XJ', 'F-Pace', 'E-Pace', 'F-Type', 'I-Pace'],
            15 => ['Soul', 'Sportage', 'Sorento', 'Optima', 'Forte', 'Stinger', 'Telluride'],
            16 => ['Outlander', 'Eclipse Cross', 'Pajero', 'Mirage', 'Lancer', 'ASX', 'Xpander'],
            17 => ['Range Rover', 'Discovery', 'Defender', 'Evoque', 'Velar', 'Freelander', 'Sport'],
            18 => ['208', '308', '3008', '508', '2008', '5008', 'Rifter'],
            19 => ['C3', 'C4', 'C5 Aircross', 'Berlingo', 'C1', 'C4 Cactus', 'Grand C4 SpaceTourer'],
            20 => ['XC90', 'XC60', 'S90', 'V60', 'XC40', 'S60', 'V90'],
            21 => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck', 'Roadster', 'Semi'],
            22 => ['RX', 'ES', 'NX', 'GX', 'LS', 'IS', 'LX'],
            23 => ['488', 'Roma', 'Portofino', '812 Superfast', 'SF90 Stradale', 'GTC4Lusso', 'F8 Tributo'],
            24 => ['Huracán', 'Aventador', 'Urus', 'Gallardo', 'Murciélago', 'Diablo', 'Reventón'],
            25 => ['DB11', 'Vantage', 'DBS Superleggera', 'Rapide', 'Vanquish', 'Vulcan', 'Valhalla'],
            26 => ['Continental GT', 'Flying Spur', 'Bentayga', 'Mulsanne', 'Arnage', 'Brooklands', 'Azure'],
            27 => ['Phantom', 'Ghost', 'Wraith', 'Dawn', 'Cullinan', 'Silver Shadow', 'Corniche'],
            28 => ['Ghibli', 'Levante', 'Quattroporte', 'GranTurismo', 'GranCabrio', 'MC20', 'Alfieri'],
            29 => ['Giulia', 'Stelvio', 'Giulietta', '4C', '8C', 'Spider', 'GTV'],
            30 => ['Chiron', 'Veyron', 'Divo', 'Centodieci', 'Bolide', 'La Voiture Noire', 'EB110'],
            31 => ['Cooper', 'Countryman', 'Clubman', 'Paceman', 'Convertible', 'Roadster', 'Coupe'],
            32 => ['500', 'Panda', 'Tipo', 'Punto', 'Doblo', 'Qubo', '124 Spider'],
            33 => ['Wrangler', 'Cherokee', 'Grand Cherokee', 'Compass', 'Renegade', 'Gladiator', 'Patriot'],
            34 => ['Charger', 'Challenger', 'Durango', 'Ram 1500', 'Journey', 'Viper', 'Magnum'],
            35 => ['300', 'Pacifica', 'Voyager', 'Aspen', 'Sebring', 'PT Cruiser', 'Crossfire'],
            36 => ['1500', '2500', '3500', 'ProMaster', 'ProMaster City', 'Dakota', 'Chassis Cab'],
            37 => ['MDX', 'RDX', 'TLX', 'ILX', 'NSX', 'RLX', 'Integra'],
            38 => ['Q50', 'Q60', 'QX50', 'QX60', 'QX80', 'G37', 'FX35'],
            39 => ['G70', 'G80', 'G90', 'GV70', 'GV80', 'Essentia', 'Mint'],
            40 => ['Navigator', 'Aviator', 'Corsair', 'Nautilus', 'Continental', 'MKZ', 'MKC'],
            41 => ['Enclave', 'Encore', 'Envision', 'LaCrosse', 'Regal', 'Verano', 'Cascada'],
            42 => ['Escalade', 'XT5', 'XT6', 'CT6', 'ATS', 'CTS', 'SRX'],
            43 => ['Sierra 1500', 'Yukon', 'Canyon', 'Acadia', 'Terrain', 'Savana', 'Hummer EV'],
            44 => ['Swift', 'Vitara', 'Jimny', 'SX4', 'Celerio', 'Baleno', 'Ignis'],
            45 => ['9-3', '9-5', '900', '9000', '96', '99', 'Sonett'],
            46 => ['Octavia', 'Superb', 'Kodiaq', 'Karoq', 'Fabia', 'Rapid', 'Scala'],
            47 => ['Clio', 'Megane', 'Captur', 'Kadjar', 'Koleos', 'Twingo', 'Scenic'],
            48 => ['Ibiza', 'Leon', 'Ateca', 'Arona', 'Tarraco', 'Toledo', 'Alhambra'],
            49 => ['Astra', 'Corsa', 'Insignia', 'Mokka', 'Zafira', 'Crossland', 'Grandland'],
            50 => ['Duster', 'Sandero', 'Logan', 'Lodgy', 'Dokker', 'Spring', 'Bigster'],
        ];

        foreach ($models as $companyId => $modelList) {
            foreach ($modelList as $modelName) {
                DB::table('model_cars')->insert([
                    'name' => $modelName,
                    'company_id' => $companyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
