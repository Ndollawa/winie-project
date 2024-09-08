<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalTreatments = Diagnosis::where('user_id', auth()->user()->id)->count();

        return view('pages.dashboard.index')
            ->with('totalTreatments', $totalTreatments)
            ->with('jsFilename', 'dashboard')
            ->with('script', 'N');
    }
}
