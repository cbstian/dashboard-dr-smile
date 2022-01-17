<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\FormLaratable;
use App\Models\Form;
use App\Exports\FormExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function storePublic(Request $request)
    {
        $rules = [
            'name'              => 'required',
            'lastname'          => 'required',
            'phone'             => 'required',
            'rut'               => 'required',
            'email'             => 'required |email',
            'commune_string'    => 'required'
        ];

        $messages = [
            '*.required' => 'El :attribute es un campo requerido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return false;

        }else{

            $form = new Form();
            $form->name = $request->input('name',null);
            $form->lastname = $request->input('lastname',null);
            $form->phone = $request->input('phone',null);
            $form->email = $request->input('email',null);
            $form->commune_string = $request->input('commune_string',null);
            $form->details = $request->input('details',null);
            $form->status_service = 0;
            $form->campaign = $request->input('campaign',null);
            $form->rut = $request->input('rut',null);
            $form->region_id = 7;
            $form->save();

        }

        return true;
    }
}
