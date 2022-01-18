<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = "regions";

    public function communes()
    {
        return $this::join('provinces','regions.id','=','provinces.region_id')
                ->join('communes','provinces.id','=','communes.province_id')
                ->where('regions.id',$this->id)
                ->select('communes.*')
                ->get();
    }
}
