<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class ProfilesService
{

    use ConsumesExternalServices;

    private $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.profiles.base_uri');
    }

    public function getProfiles($id = null)
    {
        $endpoint = (is_null($id)) ? '/profiles' : '/profiles' . "/{$id}";

        return $this->performRequest('GET', $endpoint);
    }

    public function createProfile($data)
    {
        return $this->performRequest('POST', '/profiles', $data);
    }

    public function updateProfile($data, $id)
    {
        return $this->performRequest('PUT', '/profiles' . "/{$id}", $data);
    }

    public function inactivateProfile($id)
    {
        return $this->performRequest('DELETE', '/profiles' . "/{$id}");
    }

    public function activateProfile($id)
    {
        return $this->performRequest('POST', '/profiles/activate' . "/{$id}");
    }

}
