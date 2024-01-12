<?php

namespace App\Http\Controllers\crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserCreateRequest;
use App\Http\Requests\user\UserUpdateRequest;
use App\Models\User;
use App\Services\crud\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {

        return new JsonResponse($this->userService->findAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        return  new JsonResponse($this->userService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user):JsonResponse
    {
        //
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user):JsonResponse
    {
        //
        return new JsonResponse($this->userService->update($user,$request->validated()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user):JsonResponse
    {
        //
        $this->userService->destroy($user);
        return new JsonResponse(['Message'=>'OK']);
    }
}
