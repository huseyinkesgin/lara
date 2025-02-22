<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;

class PortolioGallery extends Model
{
    protected $fillable = [
        'portfolio_id',
        'media_path',
        'order',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
