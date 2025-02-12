<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\District;
use App\Models\Neighbourhood;
use App\Models\Personnel;
use App\Models\Customer;
use App\Traits\GeneratesCode;

class Land extends Model
{
    use GeneratesCode;

    protected $fillable = [
        'enter_date',
        'customer_id',
        'area',
        'city_id',
        'district_id',
        'neighbourhood_id',
        'land',
        'parcel',
        'zooning_status',
        'similar',
        'size',
        'personnel_id',
        'description',
    ];

     public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function neighbourhood()
    {
        return $this->belongsTo(Neighbourhood::class);
    }

    public function advisor()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function scopeSearch()
    {
        return Land::where('code', 'like', '%' . $this->search . '%')
            ->orWhere('land', 'like', '%' . $this->search . '%')
            ->orWhere('parcel', 'like', '%' . $this->search . '%');
    }
}
