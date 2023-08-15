<?php

namespace App\Enums;

enum PromotionType: string
{
    case QUANTITATIVE = 'quantitative';
    case PERCENTAGE = 'percentage';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
