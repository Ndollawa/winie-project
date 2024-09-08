<?php

namespace Database\Seeders;

use App\Models\Sickness;
use Illuminate\Database\Seeder;

class SicknessSeeder extends Seeder
{
    public function run()
    {
        $sicknesses = [
            "malaria",
            "typhoid",
            "hypertension",
            "diabetes",
            "HIV/AIDS"
        ];

        foreach ($sicknesses as $sickness) {
            Sickness::create(['name' => $sickness]);
        }
    }
}
