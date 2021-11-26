<?php

namespace Ivareti\IntegrationApiIa\Collection;

use Illuminate\Support\Facades\Http;
use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumeCollection
{
    use ConsumeExternalService;

    protected $username;
    protected $password;
    protected $token;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
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
