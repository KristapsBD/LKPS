<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Exports\ParcelsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export selected parcels to an Excel file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportSelectedParcels(Request $request)
    {
        $selectedParcelIds = json_decode($request->input('selected_parcels'));

        $parcels = Parcel::whereIn('id', $selectedParcelIds)->get();

        $export = new ParcelsExport($parcels);

        $fileName = 'selected_parcels.xlsx';

        try {
            // Flash success message and initiate Excel file download
            session()->flash('success', count($parcels) . ' parcels exported successfully.');
            return Excel::download($export, $fileName);
        } catch (\Exception $e) {
            // Handle exceptions during export and redirect back with an error message
            return back()->with('error', 'Error exporting parcels: ' . $e->getMessage());
        }
    }
}
