<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Form
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string|null $rut
 * @property string|null $phone
 * @property string|null $sex
 * @property string|null $date_of_birth
 * @property string|null $address
 * @property string|null $campaign
 * @property string|null $number
 * @property string|null $details
 * @property string|null $commune_string
 * @property string|null $sucursal
 * @property int $status_service
 * @property int|null $commune_id
 * @property int|null $region_id
 * @property int|null $user_id
 * @property int $manual_entry
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCampaign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCommuneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCommuneString($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereManualEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereRut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereStatusService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUserId($value)
 * @mixin \Eloquent
 */
class Form extends Model
{
    use HasFactory;

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
