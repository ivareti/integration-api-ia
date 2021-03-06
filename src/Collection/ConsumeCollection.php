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
        $username = null,
        $password = null
    )
    {
        $this->username = $username ?? config('integration-ia.username');
        $this->password = $password ?? config('integration-ia.password');
        $this->token = $this->connect();
    }

    private function connect() {
        $datas = array(
            'username' => $this->username,
            'password' => $this->password,
        );

        $headers = array(
            'Accept' => 'application/json',
        );

        $response = $this->request('post', "auth/login/", $datas, $headers);
        return $response->json()['token'];
    }

    public function getAll() {
        return $this->request('get', "collections/");
    }

    public function getById($collectionId) {
        return $this->request('get', "collections/{$collectionId}/");
    }

    public function create($collectionName) {
        $datas = array(
            'cd_collection' => $collectionName
        );

        return $this->request('post', "collections/", $datas);
    }

    public function edit($newCollectionName, $collectionId) {
        $datas = array(
            'cd_collection' => $newCollectionName
        );

        return $this->request('put', "collections/{$collectionId}/", $datas);
    }

    public function delete($collectionId) {
        return $this->request('delete', "collections/{$collectionId}/");
    }


}
