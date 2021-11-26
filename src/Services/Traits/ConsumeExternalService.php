<?php

namespace Ivareti\IntegrationApiIa\Services\Traits;

use Illuminate\Support\Facades\Http;

trait ConsumeExternalService
{
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
        return $this->headers($headers)->withToken($this->token, "JWT")->$method($endPoint,  $formParams);
    }
}
