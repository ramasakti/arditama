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
            'kategori' => $data->payload->newest[0]->category_name ?? 'Unknown',
            'featured' => $data->payload->featured ?? null,
            'popular' => $data->payload->popular ?? [],
            'newest' => $data->payload->newest ?? []
        ]);
    }

    public function article($slug)
    {
        $client = new Client();

        // Ambil artikel berdasarkan slug
        $getArticle = $client->request('GET', env('ISPAGRAM_API_URL') . '/blog/' . $slug, [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $bodyArticle = $getArticle->getBody();
        $dataArticle = json_decode($bodyArticle);

        // Cek apakah artikel ditemukan
        if (empty($dataArticle->payload)) {
            return view('no-data');
        }

        // Ambil artikel dari kategori yang sesuai
        $getRelatedArticles = $client->request('GET', env('ISPAGRAM_API_URL') . '/category/' . $dataArticle->payload->categories[0]->value, [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);

        $bodyRelatedArticles = $getRelatedArticles->getBody();
        $relatedArticles = json_decode($bodyRelatedArticles);

        // Acak 3 artikel dari popular dan newest
        $popularAndNewest = array_merge($relatedArticles->payload->popular, $relatedArticles->payload->newest);
        shuffle($popularAndNewest);
        $randomArticles = array_slice($popularAndNewest, 0, 3);

        return view('article', [
            'article' => $dataArticle->payload,
            'related_articles' => [
                'featured' => $relatedArticles->featured ?? null,
                'random_articles' => $randomArticles,
            ]
        ]);
    }

    public function newest()
    {
        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/newest', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);

        return view('newest', [
            'newest' => $data->payload
        ]);
    }

    public function popular()
    {
        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/popular', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
                'x-app-id' => env('ISPAGRAM_APP_ID')
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);

        return view('popular', [
            'popular' => $data->payload
        ]);
    }
}
