<?php

namespace App\Models;

use App\Enums\PersonnelStatus;
use App\Models\City;
use App\Models\CreditCardExpense;
use App\Models\District;
use App\Models\Neighbourhood;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Traits\GeneratesCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use GeneratesCode;

    protected $casts = [
        'status' => PersonnelStatus::class,
    ];

    protected $fillable = [
        'code',
        'name',
        'tc_no',
        'email',
        'phone',
        'city_id',
        'district_id',
        'neighbourhood_id',
        'address',
        'image',
        'status',
        'description',
        'start_date',
        'end_date',
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

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    public function creditCardExpenses()
    {
        return $this->hasManyThrough(CreditCardExpense::class, Wallet::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%');
    }



    //  // Başlangıç tarihi için mutator (kaydetme sırasında çalışır)
    //  public function setStartDateAttribute($value)
    //  {
    //      $this->attributes['start_date'] = $value ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d') : null;
    //  }

    //  // Bitiş tarihi için mutator (kaydetme sırasında çalışır)
    //  public function setEndDateAttribute($value)
    //  {
    //      $this->attributes['end_date'] = $value ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d') : null;
    //  }

    //  // Başlangıç tarihi için accessor (görüntüleme sırasında çalışır)
    //  public function getStartDateAttribute($value)
    //  {
    //      return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    //  }

    //  // Bitiş tarihi için accessor (görüntüleme sırasında çalışır)
    //  public function getEndDateAttribute($value)
    //  {
    //      return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    //  }

}
