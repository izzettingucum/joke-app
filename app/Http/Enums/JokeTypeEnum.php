<?php

namespace App\Http\Enums;

enum JokeTypeEnum: string
{
    case SINGLE = 'Single';

    case TWO_PART = 'Two part';

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
