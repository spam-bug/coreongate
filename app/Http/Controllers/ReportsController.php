<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Exports\ClientsExport;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function index() {
        return view('admin.reports.index');
    }

    public function export(Request $request) {
        $validated = $request->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ]);

        switch ($request->action) {
            case 'PDF': 
                $clients = Client::whereBetween('created_at', [$validated['start_date'], $validated['end_date']])->get();
                $pdf = PDF::loadView('admin.reports.pdf', [
                    'clients' => $clients,
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                ]);
                return $pdf->download('reports.pdf');
                break;
            case 'excel':
                return Excel::download(new ClientsExport($validated['start_date'], $validated['end_date']), 'clients.xlsx');
                break;

            default:
                return redirect()->back()->with('error', 'Export Failed');
                break;
        }
    }
}
