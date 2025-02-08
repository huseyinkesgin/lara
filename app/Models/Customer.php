<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\GeneratesCode;
use App\Models\City;
use App\Models\District;
use App\Models\Neighbourhood;

class Customer extends Model
{
    use GeneratesCode;

    protected $fillable = [
        'code',
        'customer_type',
        'company_id',
        'customer_group',
        'name',
        'tc_no',
        'phone',
        'email',
        'city_id',
        'district_id',
        'neighbourhood_id',
        'address',
        'description',
    ];

     // ----------------------- RELATIONS ---------------------------------------------- //
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

     // ------------------------ SCOPES ---------------------------------------------- //

     public function scopeSearch($query, $search)
     {
         return $query->where('name', 'like', '%'.$search.'%')
                      ->orWhere('code', 'like', '%'.$search.'%')
                      ->orWhere('phone', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%')
                      ->orWhere('address', 'like', '%'.$search.'%')
                      ->orWhere('description', 'like', '%'.$search.'%');
     }

     public function scopeActive($query)
     {
         return $query->where('is_active', true);
     }

     public function scopeInactive($query)
     {
         return $query->where('is_active', false);
     }

     public function scopeBireysel($query)
     {
         return $query->where('customer_type', 'Bireysel');
     }

     public function scopeKurumsal($query)
     {
         return $query->where('customer_type', 'Kurumsal');
     }

     public function scopeSatıcı($query)
     {
         return $query->where('customer_group', 'Satıcı');
     }

     public function scopeAlıcı($query)
     {
         return $query->where('customer_group', 'Alıcı');
     }

     public function scopeEmlakçı($query)
     {
         return $query->where('customer_group', 'Emlakçı');
     }

     public function scopePartner($query)
     {
         return $query->where('customer_group', 'Partner');
     }



     // ----------------------- ATTRIBUTES ---------------------------------------------- //
     public function getFormattedCreatedAtAttribute()
     {
         return $this->created_at->format('d.m.Y H:i');
     }

     public function getFormattedUpdatedAtAttribute()
     {
         return $this->updated_at->format('d.m.Y H:i');
     }


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }


}
