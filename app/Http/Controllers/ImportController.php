<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ParcelsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TemplateExport;

class ImportController extends Controller
{
    /**
     * Display the import form view.
     *
     * @return \Illuminate\View\View
     */
    public function showImportForm()
    {
        return view('admin.parcel.import');
    }

    /**
     * Import parcels from the uploaded file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:csv,xls,xlsx',
            ]);

            $import = new ParcelsImport;

            Excel::import($import, $request->file('file'));

            // Get the count of successfully imported parcels
            $importCount = $import->getImportCount();

            // Check for import errors
            if ($import->getErrors()) {
                return redirect()->route('admin.parcels')->with([
                    'importErrors' => true,
                    'importValueError' => $import->getErrors(),
                    'importCount' => $importCount,
                ]);
            }

            // Redirect with success message
            return redirect()->route('admin.parcels')->with([
                'success' => $importCount == 1 ? "1 parcel imported successfully!" : "{$importCount} parcels imported successfully!",
            ]);
        } catch (\Exception $e) {
            // Handle exceptions and redirect back with error message
            return redirect()->back()->with([
                'importErrors' => true,
                'importHeaderError' => $e->getMessage(),
                'importCount' => 0,
            ]);
        }
    }

    /**
     * Download the import template.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        $fileName = 'template.xlsx';

        // Return the template file for download
        return Excel::download(new TemplateExport(), $fileName);
    }
}
