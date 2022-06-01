<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Form;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function limpiezaProfunda()
    {
        $campaign = 'limpieza-profunda';

        return view('frontend.limpieza-profunda')
                ->with('campaign',$campaign);
    }

    public function ortodoncia()
    {
        $campaign = 'ortodoncia';

        return view('frontend.ortodoncia')
                ->with('campaign',$campaign);
    }

    public function odontopediatria()
    {
        $campaign = 'odontopediatria';

        return view('frontend.odontopediatria')
                ->with('campaign',$campaign);
    }

    public function esteticadental()
    {
        $campaign = 'estetica-dental';

        return view('frontend.esteticadental')
                ->with('campaign',$campaign);
    }

    public function implantologia()
    {
        $campaign = 'implantologia';

        return view('frontend.implantologia')
                ->with('campaign',$campaign);
    }

    public function botox2()
    {
        $campaign = 'botox2';

        return view('frontend.botox2')
                ->with('campaign',$campaign);
    }

    public function botox3()
    {
        $campaign = 'botox3';

        return view('frontend.botox3')
                ->with('campaign',$campaign);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|min:2|max:255',
            'lastname' => 'required|min:2|max:255',
            'phone'    => 'required|min:2|max:255',
            'rut'      => 'required|cl_rut',
            'email'    => 'required|email',
            'campaign' => 'required|not_in:0',
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
        $form->rut = $request->input('rut',null);
        $form->email = $request->input('email',null);
        $form->campaign = $request->input('campaign',null);
        $form->save();

        return json_encode(['ok']);
    }

    public function diaDeLaMadre()
    {
        abort(404);
        return view('frontend.diamadre');
    }

    public function descargarGiftcard()
    {
        abort(404);

        $countDownload = option('countGiftcardDiaMadre',0);

        option(['countGiftcardDiaMadre' => $countDownload + 1]);

        return Storage::disk('landing')->download('GIFTCARD_drsmile.pdf');
    }
}
