<?php

namespace App\Http\Controllers;

use App\Http\Enums\Joke\BlacklistEnum;
use App\Http\Enums\Joke\JokeCategoryEnum;
use App\Http\Enums\Joke\JokeTypeEnum;
use App\Http\Requests\GetJokeRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
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

    /**
     * Retrieves a joke based on the provided parameters and returns it as a JSON response.
     *
     * @param GetJokeRequest $request The request instance containing the joke parameters.
     *
     * @param Client $client The Guzzle HTTP client instance for making API requests.
     *
     * @return JsonResponse The JSON response containing the joke data from the external API.
     *
     */
    public function getJoke(GetJokeRequest $request, Client $client): JsonResponse
    {
        $jokeCategory = $request->category && !in_array(needle: 'Any', haystack: $request->category)
            ? implode(separator: ',', array: $request->category)
            : 'Any';

        $blacklist = $request->blacklist ? implode(separator: ',', array: $request->blacklist) : null;

        $jokeType = strtolower(preg_replace(pattern: '/\s+/', replacement: '', subject: $request->type));

        $baseUrl = "https://v2.jokeapi.dev/joke/{$jokeCategory}";

        $params = array_filter(
            array: [
                'blackListFlags' => $blacklist,
                'type' => $jokeType
            ]
        );

        $url = $baseUrl . ($params ? '?' . http_build_query(data: $params) : '');

        try {
            $response = $client->get(uri: $url);

            $data = json_decode(json: $response->getBody(), associative: true);

            return response()->json(data: $data);
        }
        catch (GuzzleException $e) {
            return response()->json(data: $e->getMessage());
        }
    }
}
