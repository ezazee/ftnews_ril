<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleCSEService
{
    protected $apiKey;
    protected $cx;

    public function __construct()
    {
        $this->apiKey = config('services.google.api_key');
        $this->cx = config('services.google.cx');
    }


    public function search($query)
    {
        $response = Http::get('https://www.googleapis.com/customsearch/v1', [
            'key' => $this->apiKey,
            'cx' => $this->cx,
            'q' => $query,
        ]);

        return $response->json();
    }
}
