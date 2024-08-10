<?php

namespace App\Http\Enums;

enum JokeCategoryEnum: string
{
     case ANY = 'Any';

    case DARK = 'Dark';

    case MISC = 'Misc';

    case PROGRAMMING = 'Programming';

    CASE PUN = 'Pun';

    CASE SPOOKY = 'Spooky';

    case CHRISTMAS = 'Christmas';

    /**
     * Returns an array of the values of all enum cases.
     *
     * @return array An array containing the values of all enum cases.
     */
    public static function toArrayValues(): array
    {
        return array_column(array: self::cases(), column_key: 'value');
    }
}
