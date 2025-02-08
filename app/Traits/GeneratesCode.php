<?php

namespace App\Traits;

trait GeneratesCode
{
    /**
     * Generate the next sequential code
     *
     * @param string $prefix
     * @param int $length
     * @return string
     */
    public static function generateNextCode(string $prefix, int $length): string
    {
        $maxCode = static::max('code');

        if (is_null($maxCode)) {
            $nextNumber = 1;
        } else {
            $currentNumber = (int) substr($maxCode, strlen($prefix));
            $nextNumber = $currentNumber + 1;
        }

        return $prefix . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
    }
}
