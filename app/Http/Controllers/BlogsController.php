<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;

class BlogsController extends Controller
{
    public function landing(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/api/blog', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);

        // Check if data is empty
        if (
            empty($data->payload->jumbotron) ||
            empty($data->payload->second) ||
            empty($data->payload->third) ||
            empty($data->payload->popular) ||
            empty($data->payload->newest)
        ) {
            // Handle empty data
            return view('no-data');
        }

        return view('welcome', [
            'jumbotron' => $data->payload->jumbotron ?? [],
            'second' => $data->payload->second ?? null,
            'third' => $data->payload->third ?? [],
            'popular' => $data->payload->popular ?? [],
            'newest' => $data->payload->newest ?? []
        ]);
    }

    public function category(Request $request, $category)
    {
        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/category/' . $category, [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);

        // Check if data is empty
        if (empty($data->payload)) {
            // Handle empty data
            return view('no-data');
        }

        return view('category', [
            'kategori' => $data->payload->featured->category_name ?? 'Unknown',
            'featured' => $data->payload->featured ?? null,
            'popular' => $data->payload->popular ?? [],
            'newest' => $data->payload->newest ?? []
        ]);
    }

    public function article($slug)
    {
        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/blog/' . $slug, [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);

        // Check if data is empty
        if (empty($data->payload)) {
            // Handle empty data
            return view('no-data');
        }

        return view('article', [
            'article' => $data->payload ?? null
        ]);
    }
}
