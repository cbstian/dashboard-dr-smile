<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\FormLaratable;
use App\Models\Form;
use App\Exports\FormExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function datatable(Request $request)
    {
        return Laratables::recordsOf(Form::class, FormLaratable::class);
    }

    public function index()
    {
        $forms = Form::select('commune_string')->get()->toArray();
        $communes = Array();
        foreach ($forms as $f) {
            $communes[] = $f['commune_string'];
        }

        $status = config('status-form');
        $campaign = ['promoodonto','promoestetica'];

        return view('forms.index')
                ->with('communes',array_unique($communes))
                ->with('campaign',$campaign)
                ->with('status',$status);
    }

    public function export()
    {
        $file = 'orders-'.time().'.xlsx';

        Excel::store(new FormExport, $file, 'public');

        return json_encode([
            'url' => Storage::disk('public')->url($file)
        ]);
    }

    public function storePublic()
    {
        $form = new Form();
        $form->name = 'demoPUBLIC';
        $form->lastname = 'lastnamePUBLIC';
        $form->phone = '1111PUBLIC';
        $form->email = 'demoPUBLIC@drsmile.cl';
        $form->commune_string = "COMMUNE";
        $form->details = 'asdsad';
        $form->status_service = 0;
        $form->campaign = "";
        $form->save();

        return true;
    }
}
