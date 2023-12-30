<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use App\Models\Installer;
use App\Models\Leads;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard()
    {
        $total_agents = User::where('role', 'agent')->count();
        $total_installers = Installer::count();
        $total_funders = Funder::count();
        $total_leads = Leads::count();
        return view('index', compact('total_agents', 'total_installers', 'total_funders', 'total_leads'));
    }

    public function survey_pdf($id)
    {
        $data = Leads::with('details', 'agent_details')->find($id);
        $pdf = PDF::loadView('pdf_templates.survey', compact('data'));
        $name = now() . '_survey.pdf';
        return $pdf->stream($name);
    }
}
