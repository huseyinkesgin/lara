<?php

namespace App\Enums;

enum PersonnelStatus: string
{
    case CALISIYOR = 'ÇALIŞIYOR';
    case ISTEN_AYRILDI = 'İŞTEN AYRILDI';
    case ASKERI_GOREVDE = 'ASKERI GÖREVDE';

    public function label(): string
    {
        return match($this) {
            self::CALISIYOR => 'ÇALIŞIYOR',
            self::ISTEN_AYRILDI => 'İŞTEN AYRILDI',
            self::ASKERI_GOREVDE => 'ASKERI GÖREVDE',

        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($status) {
            return [$status->value => $status->label()];
        })->toArray();
    }
}
