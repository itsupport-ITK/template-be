<?php

namespace App\Services;

use App\Repositories\TokenRepository\TokenRepository;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class ApiService
{

    /**
     * variable that contain custom url
     * @var string
     */
    private string $url;

    /**
     * client to run api.
     *
     * @var \IIlluminate\Support\Facades\Http
     */
    private $client;


    public function __construct(
        bool $isWithToken = true,
        ?int $userId = null
    )
    {
        $url = $this->getBaseUrl();
        $this->url = $url;
        $headers = [
            'Accept' => 'application/json'
        ];

        if($isWithToken == true){

            $token = $this->getToken($userId);
            $headers['Authorization'] = 'Bearer '.$token;
            $headers['X-Language'] = app()->currentLocale();
        }

        $this->client = Http::withHeaders($headers);
    }

    /**
     * Get from api with parameters
     */
    public function get(string $uri, array $params = []):array
    {
        return $this->client->get($this->url . $uri, $params)->json();
    }

    /**
     * Post api
     */
    public function post(string $uri, array $body = []): array
    {
        return $this->client->post($this->url . $uri, $body)->json();
    }

    /**
     * Put api
     */
    public function put(string $uri, array $body = []): array
    {
        $body['_method'] = 'put';
        return $this->client->put($this->url . $uri, $body)->json();
    }

    /**
     * Update api
     */
    public function update(string $uri, array $body = []): array
    {
        return $this->client->update($this->url . $uri, $body)->json();
    }

    /**
     * Delete api
     */
    public function delete(string $uri, array $body = []) : array
    {
        return $this->client->delete($this->url . $uri, $body)->json();
    }
    
    /**
     * Get token from repo
     */
    private function getToken(int $userId): ?string{

        /**
         * Nyalakan jika mengambil token dari api lain
         */
        // $tokenRepository = new TokenRepository;
        // $token = $tokenRepository->get($userId);

        return null;
    }

    /**
     * base api url used in application
     */
    public function getBaseUrl(): string{
        
        return config('api.url');
    }
}