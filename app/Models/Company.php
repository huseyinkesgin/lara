<?php

namespace App\Models;

use App\Traits\GeneratesCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\City;
use App\Models\District;
use App\Models\Neighbourhood;

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
        'district_id',
        'neighbourhood_id',
        'address',
        'description',
        'is_active',
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

      public function scopeActive($query)
      {
          return $query->where('is_active', true);
      }

      public function scopeInactive($query)
      {
          return $query->where('is_active', false);
      }



    }
