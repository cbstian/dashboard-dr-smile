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
        $campaign = config('campaign');

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
            'name'       => 'required|min:2|max:255',
            'lastname'   => 'required|min:2|max:255',
            'phone'      => 'required|min:2|max:255',
            'rut'        => 'required|cl_rut',
            'email'      => 'required|email|confirmed',
            'region_id'  => 'required|not_in:0',
            'commune_id' => 'required|not_in:0',
            'campaign'   => 'required|not_in:0',
            'status_service' => 'required',
            'details' => 'nullable',
        ];

        $messages = [

            'name.required' => 'El Nombre es un campo requerido.',
            'name.min' => 'El Nombre es demasiado corto.',
            'name.max' => 'El Nombre es demasiado largo.',
            'lastname.required' => 'El Apellido es un campo requerido.',
            'lastname.min' => 'El Apellido es demasiado corto.',
            'lastname.max' => 'El Apellido es demasiado largo.',
            'phone.required' => 'El Teléfono es un campo requerido.',
            'phone.min' => 'El Teléfono es demasiado corto.',
            'phone.max' => 'El Teléfono es demasiado largo.',
            'rut.required' => 'El RUT es un campo requerido.',
            'rut.cl_rut' => 'El RUT no es válido.',
            'email.required' => 'El Email es un campo requerido.',
            'email.email' => 'El Email no es válido.',
            'email.confirmed' => 'Debes confirmar el Email.',
            'region_id.required' => 'La Región es un campo requerido',
            'region_id.not_in' => 'Región ingresada no válida',
            'commune_id.required' => 'La Comuna es un campo requerido',
            'commune_id.not_in' => 'Comuna ingresada no válida',
            'campaign.required' => 'La Campaña es un campo requerido',
            'campaign.not_in' => 'Campaña ingresada no válida',
            'status_service.required' => 'El Estado es un campo requerido',
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
            'rut'        => 'required',
            'email'      => 'required|email|confirmed',
            'region_id'  => 'required|not_in:0',
            'commune_id' => 'nullable',
            'campaign'   => 'required|not_in:0',
            'status_service' => 'required',
            'details' => 'nullable',
        ];

        $messages = [
            '*.required' => 'El :attribute es un campo requerido.',
            '*.not_in' => 'El :attribute es un campo requerido.',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $phone = Str::replace(' ', '', trim($request->input('phone',null)));

        $contains = Str::contains( $phone, '+569');

        if (!$contains) {
            $phone = '+569 '.$phone;
        }

        $form = Form::find($request->input('id'));
        $form->name = $request->input('name',null);
        $form->lastname = $request->input('lastname',null);
        $form->phone = $phone;
        $form->email = $request->input('email',null);
        $form->commune_id = ((int) $request->input('commune_id') == 0)? null : $request->input('commune_id',null);
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

    public function destroy(Request $request)
    {
        Form::findOrFail($request->id)->delete();

        notify()->success('Formulario eliminado correctamente!', 'Correcto');

        return redirect('forms');
    }
}
