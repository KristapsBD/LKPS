<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display all public tariffs.
     *
     * @return \Illuminate\View\View
     */
    public function viewPublicTariffs()
    {
        $publicTariffs = Tariff::where('is_public', 1)->get();
        return view('tariff.public', compact('publicTariffs'));
    }
}
