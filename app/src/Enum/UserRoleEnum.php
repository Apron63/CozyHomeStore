<?php

declare (strict_types=1);

namespace App\Enum;

enum  UserRoleEnum: string
{
    case Brand = 'brand';
    case Multi = 'multi';
    case Pharmacy = 'pharmacy';
    case Producer = 'producer';
    case Provisor24 = 'provisor24';

    public function name(): string
    {
        return match($this)
        {
            self::Brand => 'brand',
            self::Multi => 'multi',
            self::Pharmacy => 'pharmacy',
            self::Producer => 'producer',
            self::Provisor24 => 'provisor24',
        };
    }
}
