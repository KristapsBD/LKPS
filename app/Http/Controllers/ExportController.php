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

        return Excel::download($export, 'selected_parcels.xlsx');
    }
}
