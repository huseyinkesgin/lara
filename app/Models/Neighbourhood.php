<?php

namespace App\Models;

use App\Models\City;
use App\Models\District;
use App\Traits\GeneratesCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; 

class Neighbourhood extends Model
{
    use GeneratesCode;

    protected $fillable = [
        'district_id',
        'code',
        'name',
        'is_active',
        'description',
    ];

   // protected $appends = [
   //     'formatted_created_at',
   //     'formatted_updated_at'
   // ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // ----------------------- RELATIONS ---------------------------------------------- //
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // ----------------------- SCOPES ---------------------------------------------- //

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where('name', 'like', "%{$term}%")
                        ->orWhere('code', 'like', "%{$term}%");
        }
        return $query;
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
            get: fn (string $value) => $value,
            set: fn (string $value) => mb_strtoupper(trim($value), 'UTF-8')
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => mb_strtoupper(trim($value), 'UTF-8')
        );
    }


}
