<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProfilesService;

class ProfilesController extends Controller
{

    use ApiResponser;

    private $profileService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfilesService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show($id = null)
    {
        return $this->successResponse($this->profileService->getProfiles($id));
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->profileService->createProfile($request->all()), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse($this->profileService->updateProfile($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->profileService->inactivateProfile($id));
    }

    public function activate($id)
    {
        return $this->successResponse($this->profileService->activateProfile($id));
    }
}

