<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\Bank;
use App\Models\Beos\BankAccount;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class BankOffice extends Model
{
    protected $fillable = [
        'code',
        'bank_id',
        'name',
        'city_id',
        'town_id',
        'district_id',
        'neighborhood_id',
        'address',
        'authorized_name',
        'authorized_gsm',
        'authorized_phone_number',
        'authorized_extension_number',
        'authorized_email',
        'status',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function accounts()
    {
        return $this->hasMany(BankAccount::class);
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
