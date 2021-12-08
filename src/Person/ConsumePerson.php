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
            'password' => $this->password
        );

        $headers = array(
            'Accept' => 'application/json',
        );

        $response = $this->request('post', "auth/login/", $datas, $headers);
        return $response->json()['token'];
    }

    public function getAll() {
        return $this->request('get', "persons/");
    }

    public function getById($personId) {
        return $this->request('get', "persons/{$personId}/");
    }

    public function create($collectionId, $vnAge = 0, $vnGender = 0) {
        $datas = array(
            'collection_id' => $collectionId,
            'vn_age' => $vnAge,
            'vn_gender' => $vnGender
        );

        return $this->request('post', "persons/", $datas);
    }

    public function edit($personId, $vnAge = 0, $vnGender = 0) {
        $datas = array(
            'vn_age' => $vnAge,
            'vn_gender' => $vnGender
        );

        return $this->request('put', "persons/{$personId}/", $datas);
    }

    public function delete($personId) {
        return $this->request('delete', "persons/{$personId}/");
    }



}
