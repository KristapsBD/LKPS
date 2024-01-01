<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Exports\ParcelsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportSelectedParcels(Request $request)
    {
        $selectedParcelIds = json_decode($request->input('selected_parcels'));

        $parcels = Parcel::whereIn('id', $selectedParcelIds)->get();

        $export = new ParcelsExport($parcels);

        $fileName = 'selected_parcels.xlsx';

        try {
            session()->flash('success', count($parcels) . ' parcels exported successfully.');
            return Excel::download($export, $fileName);;
        } catch (\Exception $e) {
            return back()->with('error', 'Error exporting parcels: ' . $e->getMessage());
        }
    }
}
