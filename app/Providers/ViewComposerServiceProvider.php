<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('navland', $this->dataNavland());
        });
    }

    /**
     * Function to fetch navigation data from external API.
     */
    protected function dataNavland()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/navland', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Origin' => env('ISPAGRAM_API_URL'),
                    'x-app-id' => env('ISPAGRAM_APP_ID')
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $data = json_decode($body, true);

                return $data['payload'] ?? [];
            }

        } catch (\Exception $e) {
            \Log::error('Failed to fetch navigation data: ' . $e->getMessage());
            return [];
        }
    }
}
