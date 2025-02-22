<?php

namespace App\Models\Beos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Beos\PortfolioMedia;
use App\Models\Beos\PortfolioGallery;
use App\Models\Beos\PortfolioCategory;
use App\Models\Beos\PortfolioStatus;
use App\Models\Beos\PortfolioType;
use App\Models\Beos\Personnel;
use App\Models\Beos\Customer;

class Portfolio extends Model
{
    protected $fillable = [
        'code',
        'price',
        'serial_no',
        'portfolio_no',
        'portfolio_category_id',
        'portfolio_status_id',
        'portfolio_type_id',
        'status',
        'note',
        'personnel_id',
        'customer_id',
        'is_eids',
        'is_confirmed',
    ];

    public function media()
    {
        return $this->hasMany(PortolioMedia::class);
    }

    public function gallery()
    {
        return $this->hasMany(PortolioGallery::class);
    }

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class);
    }

    public function status()
    {
        return $this->belongsTo(PortfolioStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(PortfolioType::class);
    }

    public function advisor()
    {
        return $this->belongsTo(Personnel::class);
    }

    public function owner()
    {
        return $this->belongsTo(Customer::class);
    }
}
