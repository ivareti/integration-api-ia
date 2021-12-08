<?php

namespace Ivareti\IntegrationApiIa\Services\Traits;

use Illuminate\Support\Facades\Http;

trait ConsumeExternalService
{

    private $baseUrl = "https://api.ivare.com.br/v1";

    public function headers(array $headers = [])
    {
        array_push($headers, [
            'Accept' => 'application/json'
        ]);

        return Http::withHeaders($headers);
    }

    public function request(
        string $method,
        string $endPoint,
        array $formParams = [],
        array $headers = []
    ) {

        if(str_starts_with($endPoint, '/')) {
            $endPoint = substr($endPoint, 1);
        }

        return $this->headers($headers)
            ->withToken($this->token, "JWT")
            ->$method("{$this->baseUrl}/{$endPoint}",  $formParams);
    }
}
