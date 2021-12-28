<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IconFinderService
{
    /**
     * @param $query
     * @param int $count
     * @param int $offset
     * @param bool $premium
     * @return bool|mixed
     */
    public static function search($query, $count = 30, $offset = 0, $premium = false)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('iconfinder.api_key'),
        ])->get('https://api.iconfinder.com/v4/icons/search', [
            'query' => $query,
            'count' => $count,
            'offset' => $offset,
            'premium' => $premium
        ]);

        if ($response->ok()) {
            return $response->json();
        } else {
            return false;
        }
    }
}
