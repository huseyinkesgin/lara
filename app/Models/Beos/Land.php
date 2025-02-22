<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class Land extends Model
{

    protected $fillable = [
        'code',
        'portfolio_id',
        'city_id',
        'town_id',
        'district_id',
        'neighborhood_id',
        'land_no',
        'parcel_no',
        'zooning_status',
        'area_m2',
        'similar',
        'height',
        'arrival_date'
    ];

     public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function scopeSearch()
    {
        return Land::where('code', 'like', '%' . $this->search . '%')
            ->orWhere('land', 'like', '%' . $this->search . '%')
            ->orWhere('parcel', 'like', '%' . $this->search . '%');
    }
}
