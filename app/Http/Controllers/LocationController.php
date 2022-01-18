<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class LocationController extends Controller
{
    public function getCommunes(Request $request)
    {
        $region = Region::find($request->input('id'));

        $communes = ($region)? $region->communes() : [];

        return view('forms.options-communes')
                ->with('communes', $communes);
    }
}
