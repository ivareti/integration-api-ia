<?php

return [
    'ia' => array(
        'username' => env('IVARE_IA_USERNAME'),
        'password' => env('IVARE_IA_PASSWORD'),
        'url' => array(
            'base' => "https://api.ivare.com.br/v1",
            'auth' => "https://api.ivare.com.br/v1" . '/auth/login/',
            'collections' => "https://api.ivare.com.br/v1" . '/collections/',
            'persons' => "https://api.ivare.com.br/v1" . '/persons/',
            'images' => "https://api.ivare.com.br/v1" . '/images/',
            'compare' => array(
                'collection' => "https://api.ivare.com.br/v1" . '/compare/collection/liveness/',
                'collection_many' => "https://api.ivare.com.br/v1" . '/compare/collection/many/',
                'person' => "https://api.ivare.com.br/v1" . '/compare/person/liveness/',
            )
        ),
    ),
];
