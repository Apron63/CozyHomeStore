<?php

declare (strict_types=1);

namespace App\Enum;

enum CalculatorPeriodEnum: string
{
    case Current = 'curr';
    case Previous = 'prev';

    public function name(): string
    {
        return match($this)
        {
            self::Current => 'curr',
            self::Previous => 'prev',
        };
    }
}
