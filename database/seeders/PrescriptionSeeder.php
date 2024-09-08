<?php

namespace Database\Seeders;

use App\Models\Prescription;
use App\Models\Sickness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    public function run()
    {
        // Define the prescription data with dosage
        $prescriptions = [
            "malaria" => [
                ["name" => "Antimalarial drugs", "dosage" => "1 tablet every 12 hours for 3 days"],
                ["name" => "Antibiotics", "dosage" => "500 mg every 8 hours for 7 days"],
                ["name" => "Pain management", "dosage" => "2 tablets as needed for pain"],
                ["name" => "Antipyretics", "dosage" => "500 mg every 4-6 hours as needed"],
                ["name" => "Fluid replacement", "dosage" => "As required for dehydration"]
            ],
            "typhoid" => [
                ["name" => "Antibiotics", "dosage" => "500 mg every 8 hours for 14 days"],
                ["name" => "Pain management", "dosage" => "2 tablets as needed for pain"],
                ["name" => "Antipyretics", "dosage" => "500 mg every 4-6 hours as needed"],
                ["name" => "Fluid replacement", "dosage" => "As required for dehydration"],
                ["name" => "Rest", "dosage" => "Bed rest for at least 7 days"]
            ],
            "hypertension" => [
                ["name" => "Antihypertensive drugs", "dosage" => "1 tablet daily"],
                ["name" => "Diuretics", "dosage" => "25 mg once daily"],
                ["name" => "Beta blockers", "dosage" => "50 mg twice daily"],
                ["name" => "ACE inhibitors", "dosage" => "10 mg once daily"],
                ["name" => "Calcium channel blockers", "dosage" => "5 mg once daily"]
            ],
            "diabetes" => [
                ["name" => "Insulin therapy", "dosage" => "As directed by a healthcare provider"],
                ["name" => "Oral hypoglycemics", "dosage" => "1 tablet daily before meals"],
                ["name" => "Metformin", "dosage" => "500 mg twice daily with meals"],
                ["name" => "Sulfonylureas", "dosage" => "5 mg once daily before breakfast"],
                ["name" => "Glucagon-like peptide-1 (GLP-1) receptor agonists", "dosage" => "0.5 mg weekly"]
            ],
            "HIV/AIDS" => [
                ["name" => "Antiretroviral therapy", "dosage" => "As directed by a healthcare provider"],
                ["name" => "Antibiotics", "dosage" => "500 mg every 8 hours as needed"],
                ["name" => "Pain management", "dosage" => "2 tablets as needed for pain"],
                ["name" => "Antifungal therapy", "dosage" => "As directed by a healthcare provider"],
                ["name" => "Antiviral therapy", "dosage" => "As directed by a healthcare provider"]
            ]
        ];

        // Seed the data
        foreach ($prescriptions as $sicknessName => $medications) {
            $sickness = Sickness::where('name', $sicknessName)->first();

            if ($sickness) {
                foreach ($medications as $medication) {
                    Prescription::create([
                        'sickness_id' => $sickness->id,
                        'prescription' => $medication['name'],
                        'dosage' => $medication['dosage']
                    ]);
                }
            }
        }
    }
}
