<?php

namespace App\Http\Controllers;

use App\Http\Enums\Joke\BlacklistEnum;
use App\Http\Enums\Joke\JokeCategoryEnum;
use App\Http\Enums\Joke\JokeTypeEnum;
use Illuminate\View\View;

final class JokeController extends Controller
{
    /**
     * Displays the index page for jokes.
     *
     * @return View The view instance containing the joke-related data.
     */
    public function displayIndexPage(): View
    {
        $blackLists = BlacklistEnum::toArrayValues();
        $jokeCategories = JokeCategoryEnum::toArrayValues();
        $jokeTypes = JokeTypeEnum::toArrayValues();

        return view(view: 'joke',
            data: [
                'blackLists' => $blackLists,
                'jokeCategories' => $jokeCategories,
                'jokeTypes' => $jokeTypes,
            ]
        );
    }
}
