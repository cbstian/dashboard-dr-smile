<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\FormLaratable;
use App\Models\Form;
use App\Models\Region;
use App\Exports\FormExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

            $phone = Str::replace(' ', '', trim($request->input('phone',null)));

            $contains = Str::contains( $phone, '+569');

            if (!$contains) {
                $phone = '+569 '.$phone;
            }

            $form = new Form();
            $form->name = $request->input('name',null);
            $form->lastname = $request->input('lastname',null);
            $form->phone = $phone;
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

    public function store(Request $request)
    {
        $rules = [
            'name'       => 'required',
            'lastname'   => 'required',
            'phone'      => 'required',
            'rut'        => 'required|cl_rut',
            'email'      => 'required|email|confirmed',
            'region_id'  => 'required|not_in:0',
            'commune_id' => 'required|not_in:0',
            'campaign'   => 'required|not_in:0',
            'status_service' => 'required',
            'details' => 'nullable',
        ];

        $messages = [
            '*.required' => 'El :attribute es un campo requerido.',
            '*.not_in' => 'El :attribute es un campo requerido.',
            'rut.cl_rut' => 'El RUT no es válido',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $phone = Str::replace(' ', '', trim($request->input('phone',null)));

        $contains = Str::contains( $phone, '+569');

        if (!$contains) {
            $phone = '+569 '.$phone;
        }

        $form = new Form();
        $form->name = $request->input('name',null);
        $form->lastname = $request->input('lastname',null);
        $form->phone = $phone;
        $form->email = $request->input('email',null);
        $form->commune_id = $request->input('commune_id',null);
        $form->region_id = $request->input('region_id',null);
        $form->details = $request->input('details',null);
        $form->status_service = $request->input('status_service',null);
        $form->campaign = $request->input('campaign',null);
        $form->rut = $request->input('rut',null);
        $form->user_id = $request->user()->id;
        $form->manual_entry = 1;
        $form->save();

        return json_encode(['ok']);

    }

    public function create()
    {
        $regions = Region::all();
        $status  = config('status-form');

        $view = view('forms.create')
                ->with('regions',$regions)
                ->with('status',$status)
                ->render();

        return $view;
    }

    public function edit(Request $request)
    {
        $form = Form::findOrFail($request->id);
        $regions = Region::all();
        $status  = config('status-form');
        $region_id = is_null($form->region_id)? 7 : $form->region_id ;
        $communes = Region::findOrFail($region_id)->communes();

        $view = view('forms.edit')
                ->with('regions',$regions)
                ->with('status',$status)
                ->with('form',$form)
                ->with('communes',$communes)
                ->with('region_id',$region_id)
                ->render();

        return $view;
    }

    public function update(Request $request)
    {
        $rules = [
            'name'       => 'required',
            'lastname'   => 'required',
            'phone'      => 'required',
            'rut'        => 'required|cl_rut',
            'email'      => 'required|email|confirmed',
            'region_id'  => 'required|not_in:0',
            'commune_id' => 'required|not_in:0',
            'campaign'   => 'required|not_in:0',
            'status_service' => 'required',
            'details' => 'nullable',
        ];

        $messages = [
            '*.required' => 'El :attribute es un campo requerido.',
            '*.not_in' => 'El :attribute es un campo requerido.',
            'rut.cl_rut' => 'El RUT no es válido',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $phone = Str::replace(' ', '', trim($request->input('phone',null)));

        $contains = Str::contains( $phone, '+569');

        if (!$contains) {
            $phone .= '+569 '.$phone;
        }

        $form = Form::find($request->input('id'));
        $form->name = $request->input('name',null);
        $form->lastname = $request->input('lastname',null);
        $form->phone = $phone;
        $form->email = $request->input('email',null);
        $form->commune_id = $request->input('commune_id',null);
        $form->region_id = $request->input('region_id',null);
        $form->details = $request->input('details',null);
        $form->status_service = $request->input('status_service',null);
        $form->campaign = $request->input('campaign',null);
        $form->rut = $request->input('rut',null);
        $form->user_id = $request->user()->id;
        $form->manual_entry = 1;
        $form->save();

        return json_encode(['ok']);

    }
}
