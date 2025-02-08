<?php

namespace App\Models;

use App\Traits\GeneratesCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class District extends Model
{

    use GeneratesCode;

    protected $fillable = [
        'city_id',
        'code',
        'name',
        'is_active',
        'description',
    ];

    // ----------------------- RELATIONS ---------------------------------------------- //

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighbourhoods()
    {
        return $this->hasMany(Neighbourhood::class);
    }

    // ----------------------- SCOPES ---------------------------------------------- //

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

    // ----------------------- ACCESSORS ---------------------------------------------- //

    public function getAttributeCreatedAt($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function getAttributeUpdatedAt($value)
    {
        return date('d/m/Y', strtotime($value));
    }

     // ----------------------- MUTATORS ---------------------------------------------- //

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => mb_strtoupper($value, 'UTF-8')
        );
    }
}
