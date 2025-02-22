<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\BankOffice;
use App\Models\Beos\Company;
use App\Models\Beos\Personnel;
use App\Models\Beos\City;
use App\Models\Beos\District;
use App\Models\Beos\Neighborhood;
use App\Models\Beos\Town;

class BankAccount extends Model
{
    protected $fillable = [
        'code',
        'bank_office_id',
        'name',
        'account_type',
        'currency',
        'branch_code',
        'account_number',
        'iban',
        'status',
    ];


    public function bankOffice()
    {
        return $this->belongsTo(BankOffice::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function personnels()
    {
        return $this->belongsToMany(Personnel::class);
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
