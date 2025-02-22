<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\City;
use App\Traits\GeneratesCode;

class Town extends Model
{
    use GeneratesCode;
    protected $fillable = ['code', 'city_id', 'name','is_active', 'description'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function neighborhoods()
    {
        return $this->hasManyThrough(Neighborhood::class, District::class, 'town_id', 'district_id', );
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    public function getCreatedAtAttribute($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return date('d/m/Y', strtotime($date));
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
