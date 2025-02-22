<?php

namespace App\Enums;

enum IsActive: int
{
    case ACTIVE = 1;
    case PASSIVE = 0;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'AKTİF',
            self::PASSIVE => 'PASİF',
        };
    }

    public static function options(): array
    {
       return collect(self::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->label()];
        })->toArray();
    }
}
