<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class Personnel extends Model
{
    protected $fillable = [
        'code',
        'name',
        'tc_no',
        'email',
        'phone',
        'city_id',
        'district_id',
        'neighborhood_id',
        'address',
        'image',
        'status',
        'description',
        'start_date',
        'end_date',
    ];

    public function accounts()
    {
        return $this->belongsToMany(BankAccount::class);
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('phone', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

}
