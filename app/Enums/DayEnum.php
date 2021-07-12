<?php
namespace App\Enums;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DRAFT()
 * @method static self PREVIEW()
 * @method static self PUBLISHED()
 * @method static self ARCHIVED()
 */
final class DayEnum extends Enum
{
    const SAT = 0;
    const SUN = 1;
    const MON = 2;
    const TUE = 3;
    const WED = 4;
    const THU = 5;
    const FRI = 6;

    public static function attr()
    {
        return [static::SAT, static::SUN, static::MON, static::TUE, static::WED, static::THU, static::FRI];
    }
}
