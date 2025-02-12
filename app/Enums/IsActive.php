<?php

namespace App\Enums;

enum IsActive: string
{
    case ACTIVE = true;
    case PASSIVE = false;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Aktif',
            self::PASSIVE => 'Pasif',
        };
    }

    public static function options(): array
    {
       return collect(self::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->label()];
        })->toArray();
    }
}
