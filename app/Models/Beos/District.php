<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\City;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;
use App\Traits\GeneratesCode;

class District extends Model
{
    use GeneratesCode;
    protected $fillable = ['code', 'town_id', 'name', 'description', 'is_active'];

 
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }




    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
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
