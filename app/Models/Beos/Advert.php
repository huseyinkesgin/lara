<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = [
        'portfolio_id',
        'ad_websites',
        'ad_id',
        'ad_link',
    ];
}
