<?php

namespace Ivareti\IntegrationApiIa\Person;

use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumePerson
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

    public function getAll() {
        return $this->request('get', "https://api.ivare.com.br/v1/persons/");
    }

    public function getByUuid($uuid) {
        return $this->request('get', "https://api.ivare.com.br/v1/persons/{$uuid}/");
    }

    public function create($collectionUuid, $personUuid, $vnAge = 0, $vnGender = 0) {
        $datas = array(
            'collection_id' => $collectionUuid,
            'vn_age' => $vnAge,
            'vn_gender' => $vnGender,
            'uuid' => $personUuid
        );

        return $this->request('post', "https://api.ivare.com.br/v1/persons/", $datas);
    }

    public function edit($newCollectionName, $uuid) {
        $datas = array(
            'cd_collection' => $newCollectionName
        );

        return $this->request('put', "https://api.ivare.com.br/v1/persons/{$uuid}/", $datas);
    }

    public function delete($uuid) {
        return $this->request('delete', "https://api.ivare.com.br/v1/persons/{$uuid}/");
    }



}
