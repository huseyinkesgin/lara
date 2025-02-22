<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\Customer;
use App\Models\Beos\Personnel;
use App\Models\Beos\Portfolio;

class CustomerFollow extends Model
{
    protected $fillable = [
        'service_type',
        'service_date',
        'customer_id',
        'personnel_id',
        'note',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function advisor()
    {
        return $this->belongsTo(Personnel::class);
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }
}
