<?php

declare (strict_types=1);

namespace App\Enum;

enum  NewsTypeEnum: string
{
    case Event = 'event';
    case News = 'news';

    public function name(): string
    {
        return match($this)
        {
            self::Event => 'Мероприятие',
            self::News => 'Событие',
        };
    }
}
