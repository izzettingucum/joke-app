<?php

namespace App\Http\Enums\Joke;

enum BlacklistEnum: string
{
    case NSFW = 'Nsfw';

    case RELIGIOUS = 'religious';

    case POLITICAL = 'political';

    case EXPLICIT = 'explicit';

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
