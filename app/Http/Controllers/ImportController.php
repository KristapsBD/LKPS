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
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        $import = new ParcelsImport;
        Excel::import($import, $request->file('file'));

        return redirect()->route('admin.parcels')->with('success', 'Parcels imported successfully!');
    }
}
