<?php

namespace Database\Seeders;

use App\Models\Medics;
use Illuminate\Database\Seeder;

class MedicsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
