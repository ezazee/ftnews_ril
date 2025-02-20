<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatGptController extends Controller
{
    public function chat(Request $request)
    {
        $apiKey = env('OPENAI_API_KEY');
        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => $request->input('messages'),
                'max_tokens' => 150,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json([
            'message' => $data['choices'][0]['message']['content']
        ]);
    }
}

