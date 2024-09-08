<?php

namespace Database\Seeders;

use App\Models\Sickness;
use App\Models\Symptom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    public function run()
    {
        $knowledgeBase = [
            "malaria" => [
                "fever",
                "chills",
                "headache",
                "muscle pain",
                "joint pain",
                "fatigue",
                "nausea",
                "vomiting",
                "diarrhea",
                "anemia"
            ],
            "typhoid" => [
                "fever",
                "abdominal pain",
                "headache",
                "fatigue",
                "muscle aches",
                "joint pain",
                "nausea",
                "vomiting",
                "diarrhea",
                "constipation"
            ],
            "hypertension" => [
                "headache",
                "dizziness",
                "chest pain",
                "shortness of breath",
                "fatigue",
                "confusion",
                "vision changes",
                "nausea",
                "vomiting"
            ],
            "diabetes" => [
                "increased thirst",
                "frequent urination",
                "fatigue",
                "blurred vision",
                "slow healing of cuts and wounds",
                "tingling or numbness in hands and feet",
                "recurrent skin, gum, or bladder infections",
                "flu-like symptoms",
                "stomach pain"
            ],
            "HIV/AIDS" => [
                "weight loss",
                "fever",
                "night sweats",
                "fatigue",
                "swollen glands",
                "rash",
                "muscle aches",
                "joint pain",
                "nausea",
                "vomiting",
                "diarrhea"
            ]
        ];

        foreach ($knowledgeBase as $sicknessName => $symptoms) {
            $sickness = Sickness::where('name', $sicknessName)->first();

            if ($sickness) {
                foreach ($symptoms as $symptomName) {
                    Symptom::create([
                        'sickness_id' => $sickness->id,
                        'name' => $symptomName,
                        'description' => null, // Add descriptions if needed
                    ]);
                }
            }
        }
    }
}
