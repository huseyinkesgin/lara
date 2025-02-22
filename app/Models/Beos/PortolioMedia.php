<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\Portfolio;

class PortolioMedia extends Model
{
    protected $fillable = [
        'portfolio_id',
        'media_type',
        'media_path',
        'order',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
