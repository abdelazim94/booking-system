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
    const SAT = 1;
    const SUN = 2;
    const MON = 3;
    const TUE = 4;
    const WED = 5;
    const THU = 6;
    const FRI = 7;

    // protected static function values(): array
    // {
    //     return [
    //          'SAT' => 0,
    //          'SUN' => 1,
    //          'MON' => 2,
    //          'TUE' => 3,
    //          'WED' => 4,
    //          'THU' => 5,
    //          'FRI' => 6
    //     ];
    // }

    public static function attr()
    {
        return [static::SAT, static::SUN, static::MON, static::TUE, static::WED, static::THU, static::FRI];
    }
}
