<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\Town;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\BankOffice;

class Bank extends Model
{
    protected $fillable = [
        'code',
        'name',
        'city_id',
        'town_id',
        'district_id',
        'neighborhood_id',
        'address',
        'phone',
        'email',
        'website',
        'customer_phone',
        'status',
    ];

    public function offices()
    {
        return $this->hasMany(BankOffice::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function personnels()
    {
        return $this->belongsToMany(Personnel::class);
    }

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
