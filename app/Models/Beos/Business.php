<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;

class Business extends Model
{
    protected $fillable = [
        'code',
        'portfolio_id',
        'city_id',
        'town_id',
        'district_id',
        'neighborhood_id',
        'area_m2',
        'land_no',
        'parcel_no',
        'open_area',
        'closed_area',
        'business_area',
        'office_area',
        'height',
        'electric_capacity',
        'year',
        'usage_status',
        'building_status',
        'floor_count',
        'which_floor',
        'heating',
        'entrance_gate_count',
        'ramp_count',
        'is_crane',
        'crane_description',
        'arrival_date'
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }   

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
