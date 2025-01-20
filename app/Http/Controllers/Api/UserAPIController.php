<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\UserRepository\UserRepository;
use Illuminate\Http\Request;

class UserAPIController extends BaseApiController
{
    /**
     * get list of users with given parameters
     *
     *
     * @return Response
     * @OA\Get(
     *     path="/user/list",
     *     summary="get list of users",
     *     tags={"Users"},
     *     security={{"Bearer":{}}},
     *   @OA\Response(
     *          response="200",
     *          description="users successfully created"
     *   ),
     *  @OA\Response(
     *     response="400",
     *     description="Invalid input"
     *   )
     * )
     */
    public function list(Request $request, UserRepository $userRepository)
    {

        $data = $userRepository->list($request->all());

        return $this->sendSuccess($data, __('messages.users.list'));
    }


    /**
     *  Create User
     *
     *
     * @return Response
     *  @OA\Post(
     *      path="/user/store",
     *      operationId="createUser",
     *      summary="create user",
     *      description="create user",
     *      tags={"Users"},
     *      security={{"Bearer":{}}},
     *      @OA\RequestBody(
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="User berhasil ditambahkan",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  ref="#/components/schemas/User"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Invalid input"
     *      )
     *  )
     */
    public function store(StoreUserRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->store($request->validated());

        return $this->sendSuccess($user, __('messages.users.store'));
    }


    /**
     * Update user
     *
     *
     * @return Response
     * @OA\Put(
     *     path="/user/update/{user}",
     *     summary="update user",
     *     tags={"Users"},
     *     security={{"Bearer":{}}},
     *  @OA\Parameter(
     *     name="user",
     *     in="path",
     *     required=true,
     *     description="id user",
     *     @OA\Schema(
     *       type="integer",
     *     )
     *   ),
     *  @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/User")
     *   ),
     *     @OA\Response(
     *          response="200",
     *          description="user successfully updated"
     *   ),
     *  @OA\Response(
     *     response="400",
     *     description="Invalid input"
     *   )
     * )
     */
    public function update(User $user, UpdateUserRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->update($user, $request->validated());
        return $this->sendSuccess($user, __('messages.users.update'));
    }


    /**
     * Delete user
     *
     * @return Response
     *
     * @OA\Delete(
     *   path="/user/delete/{user}",
     *   summary="Delete user",
     *   tags={"Users"},
     *   security={{"Bearer":{}}},
     *
     *   @OA\Parameter(
     *     name="user",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *     )
     *   ),
     *
     *   @OA\Response(
     *     response="204",
     *     description="user deleted",
     *   ),
     *   @OA\Response(
     *     response="400",
     *     description="Invalid input",
     *   )
     * )
     */
    public function delete(User $user, UserRepository $userRepository)
    {

        $userRepository->delete($user);

        return $this->sendSuccess(null, __('messages.users.delete'));
    }
}
