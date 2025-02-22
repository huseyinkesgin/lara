<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;
use App\Traits\GeneratesCode;

class City extends Model
{
    use GeneratesCode;
    protected $fillable = ['code','name','is_active','description'];

  
    public function towns()
    {
        return $this->hasMany(Town::class);
    }

    public function districts()
    {
        return $this->hasManyThrough(District::class, Town::class, 'city_id', 'town_id');
    }



    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    public function scopeCustomOrder($query)
    {
        return $query->orderByRaw("
            CASE 
                WHEN name = 'İSTANBUL' THEN 1
                WHEN name = 'KOCAELİ' THEN 2
                ELSE 3
            END
        ")->orderBy('name');
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
