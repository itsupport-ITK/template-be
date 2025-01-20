<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Auth\LoginAPIRequest;
use App\Repositories\AuthRepository\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseApiController
{
    /**
     *  @OA\Post(
     *      path="/auth/login",
     *      operationId="postLogin",
     *      summary="Login to access",
     *      tags={"Authentication"},
     *      description="Return login user",
     *      @OA\RequestBody(
     *          required = true,
     *          @OA\JsonContent(
     *              required={"email", "password"},
     *              @OA\Property(
     *                      property="email", 
     *                      type="string", 
     *                      format="string", 
     *                      example="itsupport@itk.ac.id"
     *              ),
     *              @OA\Property(
     *                      property="password", 
     *                      type="string", 
     *                      format="string", 
     *                      example="its124"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="post successfully retrieved"
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Invalid input"
     *      )
     *  )
     */
    public function login(LoginAPIRequest $request, AuthRepository $authRepository)
    {
        $data = $authRepository->login($request->email);

        return $this->sendSuccess($data, __('messages.auth.login'));
    }

     /**
     * @return Response
     *
     * @OA\Get(
     *      path="/auth/profile",
     *      summary="Get user profile and data",
     *      tags={"Authentication"},
     *      description="Do get profile",
     *      security={{"Bearer":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *      )
     * )
     */
    public function profile(AuthRepository $authRepository)
    {

        $user = Auth::user();
        $profile = $authRepository->profile($user->id);

        return $this->sendSuccess($profile, __('messages.auth.login'));
    }

    /**
     * @return Response
     *
     * @OA\Post(
     *      path="/auth/logout",
     *      summary="Logout user and revoke all token",
     *      tags={"Authentication"},
     *      description="Do Logout",
     *      security={{"Bearer":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *      )
     * )
     */
    public function logout(AuthRepository $authRepository)
    {

        $authRepository->logout(Auth::user());

        return $this->sendSuccess(null, __('messages.auth.logout'));
    }
}
