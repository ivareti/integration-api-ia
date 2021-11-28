<?php

namespace Ivareti\IntegrationApiIa\Collection;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumeCollection
{
    use ConsumeExternalService;

    protected $username;
    protected $password;
    protected $token;

    public function __construct(
        $username,
        $password
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->token = $this->connect();
    }

    private function connect() {

        Log::info(config('integration-ia.username'));
        Log::info(config('integration-ia.password'));

        $datas = array(
            'username' => config('integration-ia.username'),
            'password' => config('integration-ia.password'),
        );

        $headers = array(
            'Accept' => 'application/json',
        );

        $response = $this->request('post', "https://api.ivare.com.br/v1/auth/login/", $datas, $headers);
        return $response->json()['token'];
    }

    public function getAll() {
        return $this->request('get', "https://api.ivare.com.br/v1/collections/");
    }

    public function getByUuid($uuid) {
        return $this->request('get', "https://api.ivare.com.br/v1/collections/{$uuid}/");
    }

    public function create($collectionName, $uuid) {
        $datas = array(
            'cd_collection' => $collectionName,
            'uuid' => $uuid
        );

        return $this->request('post', "https://api.ivare.com.br/v1/collections/", $datas);
    }

    public function edit($newCollectionName, $uuid) {
        $datas = array(
            'cd_collection' => $newCollectionName
        );

        return $this->request('put', "https://api.ivare.com.br/v1/collections/{$uuid}/", $datas);
    }

    public function delete($uuid) {
        return $this->request('delete', "https://api.ivare.com.br/v1/collections/{$uuid}/");
    }


}
