<?php

namespace App\Laratables;

use App\Models\Region;
use App\Models\Commune;

class FormLaratable
{
    public static function laratablesQueryConditions($query)
	{
        $commune = request('filter_commune','0');
        $date_range = request('filter_date',0);
        $status_service = request('filter_status','null');
        $campaign = request('filter_campaign','0');

        if ($commune !== "0") {
            $query = $query->where('commune_string',$commune);
        }

        if ($campaign !== "0") {
            $query = $query->where('campaign',$campaign);
        }

        if ($date_range !== 0) {
            $date_input = explode('hasta',$date_range);

            $query = $query->whereDate('created_at','>=',$date_input[0])
                            ->whereDate('created_at','<=',$date_input[1]);
        }

        if ($status_service !== 'null') {
            $query = $query->where('status_service',$status_service);
        }

        return $query;
	}

    public static function laratablesAdditionalColumns()
	{
        return ['created_at','status_service','commune_string','region_id','commune_id'];
    }

    public static function laratablesCustomCreatedAt($form)
	{
		return $form->created_at->format('d-m-Y');
	}

    public static function  laratablesCustomRegion($form)
    {
        if (!is_null($form->region_id)) {
            return Region::find($form->region_id)->region;
        }

        return '-';
    }

    public static function  laratablesCustomCommuneId($form)
    {
        if (!is_null($form->commune_id)) {
            return Commune::find($form->commune_id)->commune;
        }

        if (is_null($form->commune_id) AND !is_null($form->commune_string)) {
            return $form->commune_string;
        }

        return '-';
    }

    public static function laratablesSearchRegion($query, $searchValue)
	{
        $region = Region::where('region','like','%'.$searchValue.'%')->first();

        if($region) {
            return $query->orWhere('forms.region_id', $region->id);
        } else {
            return $query;
        }
    }

    public static function laratablesOrderRegion()
    {
        return 'region_id';
    }

    public static function laratablesRowClass($form)
    {
        $codeStatusService = config('status-form');

        return $codeStatusService[$form->status_service]['table'];
    }

    public static function laratablesCustomEstado($form)
	{
        $codeStatusService = config('status-form');

        return '<span class="badge '. $codeStatusService[$form->status_service]["color"] .' edit-form" style="cursor:pointer;" data-id="'.$form->id.'">
                    <i class="fas fa-edit"></i> '. ucwords($codeStatusService[$form->status_service]["texto"]) .'
                </span>';
	}
}
