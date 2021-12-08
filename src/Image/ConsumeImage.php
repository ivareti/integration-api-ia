<?php

namespace Ivareti\IntegrationApiIa\Image;

use Ivareti\IntegrationApiIa\Services\Traits\ConsumeExternalService;

class ConsumeImage
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

    public function getById($imageId) {
        return $this->request('get', "images/{$imageId}/");
    }

    public function create($personId, $image64) {
        $datas = array(
            'person_id' => $personId,
            'photo' => $image64
        );

        return $this->request('post', "images/", $datas);
    }

}
