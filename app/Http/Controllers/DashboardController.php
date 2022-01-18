<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Form;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $meses = [
        "01"  => "Enero",
        "02"  => "Febrero",
        "03"  => "Marzo",
        "04"  => "Abril",
        "05"  => "Mayo",
        "06"  => "Junio",
        "07"  => "Julio",
        "08"  => "Agosto",
        "09"  => "Septiembre",
        "10"  => "Octubre",
        "11"  => "Noviembre",
        "12"  => "Diciembre",
    ];

    public function index()
    {
        $total = number_format( Form::count(), 0 , '' , '.' );
        $formPromoOdonto = number_format( Form::where('campaign','promoodonto')->count(), 0 , '' , '.' );
        $formPromoEstetica = number_format( Form::where('campaign','promoestetica')->count(), 0 , '' , '.' );

        $forms = DB::table('forms')->select('created_at')->distinct()->orderBy('created_at','desc')->get();
        $fechas = Array();

        foreach($forms as $f)
            $fechas[ date('Y-m', strtotime($f->created_at)) ] = $this->meses[date('m', strtotime($f->created_at))] . ' ' . date('Y', strtotime($f->created_at));

        return view('dashboard')
                ->with('meses',$fechas)
                ->with('total',$total)
                ->with('formPromoOdonto',$formPromoOdonto)
                ->with('formPromoEstetica',$formPromoEstetica);
    }

    public function grafico1(Request $request)
    {
        $fecha = $request->input('fecha',date('Y-m'));

        $total = Form::where('created_at','like',$fecha . '%')->count();
        $promoodonto = Form::where('campaign','promoodonto')->where('created_at','like',$fecha . '%')->count();
        $promoestetica = Form::where('campaign','promoestetica')->where('created_at','like',$fecha . '%')->count();

        $mes = date('m', strtotime( $fecha ));
        $anio = date('Y', strtotime( $fecha ));

        $data["title"] = "Total: ".number_format($total,0,'','.');
        $data["subtitle"] = $this->meses[$mes] . ' ' . $anio;
        $data["promoodonto"  ] = $promoodonto;
        $data["promoestetica"] = $promoestetica;

        return json_encode($data);
    }

    public function grafico2(Request $request)
    {
        $fecha = $request->input('fecha',date('Y-m'));

        $mes = date('m', strtotime( $fecha ));
        $anio = date('Y', strtotime( $fecha ));

        $data = [
            'subtitle' => $this->meses[$mes] . ' ' . $anio,
            'pendiente' => Form::where('created_at','like',$fecha . '%')->where('status_service',0)->count(),
            'contactado' => Form::where('created_at','like',$fecha . '%')->where('status_service',1)->count(),
            'nocontesta' => Form::where('created_at','like',$fecha . '%')->where('status_service',2)->count(),
        ];

        return json_encode($data);
    }

    public function grafico3(Request $request)
    {
        $cantMeses = (int) $request->input('cantmeses',6);

        $data = Array();

        $meses = Array();
        $meses2 = Array();
        $dt = Carbon::now();
        $dt->subMonth($cantMeses-1);

        for($i=1; $i<=$cantMeses; $i++)
        {
            $meses[] = $dt->format('Y-m');
            $meses2[] = $this->meses[$dt->format('m')].' '.$dt->format('Y');
            $dt->addMonth();
        }

        foreach($meses as $mes)
        {
            $data["promoodonto"][] = Form::where('campaign','promoodonto')->where('created_at','like',$mes.'%')->count();
            $data["promoestetica"][] = Form::where('campaign','promoestetica')->where('created_at','like',$mes.'%')->count();
        }

        $data["categories"] = $meses2;

        return json_encode($data);
    }

    public function grafico4(Request $request)
    {
        $inputFecha = $request->input('fecha',date('Y-m'));
        $mes = date('m', strtotime( $inputFecha ));
        $anio = date('Y', strtotime( $inputFecha ));

        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

        $data = Array();

        $data["title"] = "Análisis diario " . $this->meses[$mes] . " " . $anio;

        if( $inputFecha == date('Y-m') ){
            $dias = (int) date('j');
        }

        for($i=1; $i<=$dias; $i++)
        {
            $fecha = null;

            if($i<10){
                $fecha = $inputFecha.'-0'.$i.'%';
            }else{
                $fecha = $inputFecha.'-'.$i.'%';
            }

            $data["categories"][] = $i;
            $data["promoodonto"][] = Form::where('campaign','promoodonto')->where('created_at','like',$fecha)->count();
            $data["promoestetica"][] = Form::where('campaign','promoestetica')->where('created_at','like',$fecha)->count();
        }

        return json_encode($data);
    }
}
