<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function limpiezaProfunda()
    {
        return view('frontend.limpieza-profunda');
    }

    public function ortodoncia()
    {
        return view('frontend.ortodoncia');
    }

    public function odontopediatria()
    {
        return view('frontend.odontopediatria');
    }

    public function esteticadental()
    {
        return view('frontend.esteticadental');
    }

    public function implantologia()
    {
        return view('frontend.implantologia');
    }

    public function botox2()
    {
        return view('frontend.botox2');
    }

    public function botox3()
    {
        return view('frontend.botox3');
    }
}
