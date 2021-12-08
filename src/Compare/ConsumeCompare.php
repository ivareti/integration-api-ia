<?php

namespace Ivareti\IntegrationApiIa\Compare;

use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumeCompare
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

    public function comparePerson($personId, $image64, $threshold = 60)
    {
        $datas = array(
            'threshold' => $threshold,
            'person_id' => $personId,
            'photo' => $image64
        );

        return $this->request('post', "compare/person/", $datas);
    }

    public function comparePersonLiveness($personId, array $images, $threshold = 60)
    {
        $datas = array(
            'threshold' => $threshold,
            'person_id' => $personId,
            'photos' => $images
        );

        return $this->request('post', "compare/person/liveness/", $datas);
    }

    public function compareCollection($collectionId, $image64, $threshold = 60)
    {
        $datas = array(
            'threshold' => $threshold,
            'collection_id' => $collectionId,
            'photo' => $image64
        );

        return $this->request('post', "compare/collection/", $datas);
    }

    public function compareCollectionLiveness($collectionId, array $images, $threshold = 60)
    {
        $datas = array(
            'threshold' => $threshold,
            'collection_id' => $collectionId,
            'photos' => $images
        );

        return $this->request('post', "compare/collection/liveness/", $datas);
    }


}
