<?php

namespace App\Models;

use App\Traits\GeneratesCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class City extends Model
{
    use GeneratesCode;

    protected $fillable = [
        'code',
        'name',
        'is_active',
        'description',
    ];

    protected $appends = [
        'formatted_created_at',
        'formatted_updated_at'
    ];

    // ----------------------- RELATIONS ---------------------------------------------- //
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    // ----------------------- SCOPES ---------------------------------------------- //

    public function scopeSearch($query, $search=null)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('name', 'asc');
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false)->orderBy('name', 'asc');
    }

    // ----------------------- ACCESSORS ---------------------------------------------- //

     public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->format('d.m.Y');
    }

    // ----------------------- MUTATORS ---------------------------------------------- //

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => $value,
            set: fn (string $value) => mb_strtoupper(trim($value), 'UTF-8')
        );
    }

    protected function code(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => $value,
            set: fn (string $value) => mb_strtoupper(trim($value), 'UTF-8')
        );
    }

   
}
