<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class Customer extends Model
{
    protected $fillable = [
        'code',
        'customer_type',
        'customer_source',
        'customer_group',
        'name',
        'tc_no',
        'phone',
        'second_phone',
        'email',
        'city_id',
        'district_id',
        'neighborhood_id',
        'address',
        'description',
    ];
 // ----------------------- RELATIONS ---------------------------------------------- //
public function companies()
{
    return $this->belongsToMany(Company::class);
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

    // Arama için scope
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('phone', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('tc_no', 'like', '%' . $search . '%');
        });
    }

  
}
