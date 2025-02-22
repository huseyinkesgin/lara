<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Town;
use App\Models\Beos\Neighborhood;
use App\Traits\GeneratesCode;

class Company extends Model
{
    use GeneratesCode;

    protected $fillable = [
        'code',
        'name',
        'tax_name',
        'tax_office',
        'tax_number',
        'phone',
        'email',
        'mersis_number',
        'kep_address',
        'website',
        'city_id',
        'town_id',
        'district_id',
        'neighborhood_id',
        'address',
        'description',
        'status',
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

      // ----------------------- SCOPES ---------------------------------------------- //

      public function scopeSearch($query, $search)
      {
          return $query->where('name', 'like', '%' . $search . '%')
                       ->orWhere('tax_name', 'like', '%' . $search . '%')
                       ->orWhere('tax_office', 'like', '%' . $search . '%')
                       ->orWhere('tax_number', 'like', '%' . $search . '%')
                       ->orWhere('phone', 'like', '%' . $search . '%')
                       ->orWhere('email', 'like', '%' . $search . '%');
      }


    }
