<?php

namespace App\Enums;

enum PersonnelStatus: string
{
    case CALISIYOR = 'CALISIYOR';
    case ISTEN_AYRILDI = 'ISTEN_AYRILDI';

    public function label(): string
    {
        return match($this) {
            self::CALISIYOR => 'ÇALIŞIYOR',
            self::ISTEN_AYRILDI => 'İŞTEN AYRILDI',

        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->label()];
        })->toArray();
    }
}
