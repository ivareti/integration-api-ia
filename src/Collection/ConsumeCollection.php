<?php

namespace Ivareti\IntegrationApiIa\Collection;

use Illuminate\Support\Facades\Http;
use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumeCollection
{
    use ConsumeExternalService;


    private $username;
    private $password;
    private $token;

    public function __construct()
    {
        $this->username = config('variables.ia.username');
        $this->password = config('variables.ia.password');
        $this->token = $this->connect();
    }

    private function connect() {

        $datas = array(
            'username' => $this->username,
            'password' => $this->password
        );

        $headers = array(
            'Accept' => 'application/json',
        );

        $response = $this->request('post', "https://api.ivare.com.br/v1/auth/login/", $datas, $headers);
        return $response->json()['token'];
    }

    public function create($nameCollection, $uuid) {
        $datas = array(
            'cd_collection' => $nameCollection,
            'uuid' => $uuid
        );

        return $this->request('post', "https://api.ivare.com.br/v1/collections/", $datas);
    }
}
