<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ParcelsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.parcel.import');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:csv,xls,xlsx',
            ]);

            $import = new ParcelsImport;
            Excel::import($import, $request->file('file'));

            $importCount = $import->getImportCount();

            if ($import->getErrors()) {
                return redirect()->route('admin.parcels')->with(['importErrors' => true, 'importValueError' => $import->getErrors(), 'importCount' => $importCount]);
            }

            return redirect()->route('admin.parcels')->with(['success' => "{$importCount} parcels imported successfully!"]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['importErrors' => true, 'importHeaderError' => $e->getMessage(), 'importCount' => 0]);
        }
    }
}
