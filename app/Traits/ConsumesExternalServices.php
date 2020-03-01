<?php

use GuzzleHttp\Client;

trait ConsumesExternalServices
{

    public function __construct($service)
    {
        $this->client = new Client([
            'base_uri' => env('API_URL') . ':' . $this->servicePort($service)
        ]);
    }

    public function performRequest($method, $url, $params = [], $headers = [])
    {

        $response = $this->client->request($method, $url, [
            'form_params' => $params,
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();

    }

    public function servicePort($service)
    {
        switch ($service) {
            case 'profiles':
                $port = env('PROFILES_PORT');
                break;
        }

        return $port;
    }

}
