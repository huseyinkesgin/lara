<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesCode;

class Neighborhood extends Model
{
    use GeneratesCode;
    
    protected $fillable = [
        'code',
        'district_id',
        'name',
        'is_active',
        'description'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function town()
    {
        return $this->hasOneThrough(Town::class, District::class, 'id', 'id', 'district_id', 'town_id');
    }

    public function city()
    {
        return $this->hasOneThrough(City::class, Town::class, 'id', 'id', 'town_id', 'city_id');
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
