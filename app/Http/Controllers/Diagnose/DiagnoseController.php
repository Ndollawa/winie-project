<?php

namespace App\Http\Controllers\Diagnose;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Sickness;
use App\Models\Symptom;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view('pages.diagnose.index')
            ->with('script', 'N');
    }

    public function getSymptoms()
    {
        $symptoms = Symptom::pluck('name'); // Assuming 'name' is the symptom name column
        return response()->json($symptoms);
    }

    public function getTopSicknesses(Request $request)
    {
        // Validate and get the user_id from the request (you may need to adjust based on your authentication method)
        $userId = $request->user()->id; // Assuming you are using Laravel's authentication

        $selectedSymptoms = $request->input('symptoms', []);

        // Retrieve the top sicknesses with the top two symptoms matching the selected symptoms
        $topSicknesses = Sickness::whereHas('symptoms', function ($query) use ($selectedSymptoms) {
            $query->whereIn('name', $selectedSymptoms);
        })
            ->with(['prescriptions:prescription,sickness_id,dosage']) // Ensure prescriptions are eager loaded with dosage
            ->take(2)
            ->get();

        // Check if any sicknesses were found
        if ($topSicknesses->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No sicknesses found for the selected symptoms.'], 404);
        }

        // Store the diagnoses for the found sicknesses
        foreach ($topSicknesses as $sickness) {
            Diagnosis::create([
                'sickness_id' => $sickness->id,
                'user_id' => $userId,
            ]);
        }

        // Map the result to your desired response structure
        $response = $topSicknesses->map(function ($sickness) {
            return [
                'sickness' => $sickness->name,
                'prescriptions' => $sickness->prescriptions->map(function ($prescription) {
                    return [
                        'name' => $prescription->prescription,
                        'dosage' => $prescription->dosage,
                    ];
                })->toArray()
            ];
        });

        return response()->json($response);
    }
}
