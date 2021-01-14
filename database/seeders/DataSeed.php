<?php

namespace Database\Seeders;

use App\Models\Pacients;
use App\Models\Medics;
use App\Models\Problems;
use App\Models\Address;
use App\Models\Phones;
use Illuminate\Database\Seeder;

class DataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pacients::create([
            "full_name"=>"João da Silva",
            "document"=>"12345678915",
            "email"=>"joaodasilva@hotmail.com",
            "gender"=>"male",
            "birth"=>"2020-10-20",
            "blood"=>"A+",
            "allergy"=>"Alergia a paracetamol"
        ]);
        Address::create([
            "address"=>"Av. Principal",
            "number"=>"32",
            "neighborhood"=>"Santa Fé",
            "city"=>"Vila Velha",
            "state"=>"ES",
            "pacient_id"=>1,
            "main"=> true,
            "zip_code"=>"29153635"
        ]);
        Phones::create([
            "owner"=>"Mariana da Silva", 
            "number"=>"912345679", 
            "pacient_id"=>1,
            "type"=>"cell_phone", 
            "prefixed"=>"27", 
            "main"=> true
        ]);
        
        Medics::create([
            'name' => "Medico 01",
            "email" => 'medico01@clinic.com',
            "crm" => '12345',
            "function" => 'Clinco Geral',
            "active" => true
        ]); 
        Medics::create([
            'name' => "Medico 02",
            "email" => 'medico02@clinic.com',
            "crm" => '54321',
            "function" => 'Clinco Geral',
            "active" => false
        ]); 
        Medics::create([
            'name' => "Medico 03",
            "email" => 'medico03@clinic.com',
            "crm" => '10332',
            "function" => 'Pediatra',
        ]); 
        Problems::create([
            "gravity"=>"green",
            "diagnostic_type"=>"entry",
            "diagnostic"=>"Paciente deu entrada com fortes sintomas de enjoo.",
            "pacient_id"=>1,
            "medic_id"=>1
        ]);

        
    }
}
