<?php

namespace App\Http\Controllers\Prescription;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        // Retrieve all prescriptions with related sickness names
        $prescriptions = Prescription::with('sickness')->get();

        // Pass the prescriptions to the view
        return view('pages.prescription.index', compact('prescriptions'))->with('script', 'N');;
    }
}
