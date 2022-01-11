<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormExport implements FromView
{
    public function view(): View
    {
        $forms = Form::orderBy('id','asc');

        $commune = request('filter_commune','0');
        $date_range = request('filter_date',0);
        $status_service = request('filter_status','null');
        $campaign = request('filter_campaign','0');

        if ($commune !== "0") {
            $forms = $forms->where('commune_string',$commune);
        }

        if ($campaign !== "0") {
            $forms = $forms->where('campaign',$campaign);
        }

        if ($date_range !== 0) {
            $date_input = explode('hasta',$date_range);

            $forms = $forms->whereDate('created_at','>=',$date_input[0])
                            ->whereDate('created_at','<=',$date_input[1]);
        }

        if ($status_service !== 'null') {
            $forms = $forms->where('status_service',$status_service);
        }

        $forms = $forms->get();

        return view('exports.forms', [
            'forms' => $forms
        ]);
    }
}
