<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{

    public function performRequest($method, $url, $params = [], $headers = [])
    {

        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $url, [
            'form_params' => $params,
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();

    }

}
