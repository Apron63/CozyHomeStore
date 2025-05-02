<?php

declare (strict_types=1);

namespace App\Enum;

enum  PartnerTypeEnum: string
{
    case Default = 'default';
    case Info = 'info';

    public function name(): string
    {
        return match($this)
        {
            self::Default => 'default',
            self::Info => 'info',
        };
    }
}
