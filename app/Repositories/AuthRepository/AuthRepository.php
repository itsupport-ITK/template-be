<?php

namespace App\Repositories\AuthRepository;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RoleRepository\RoleRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserSettingRepository\UserSettingRepository;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepository
{
    
    private $roleRepository;
    private $userRepository;

    public function __construct(
        RoleRepository $roleRepository,
        UserRepository $userRepository
        ) {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }
    //define your function here
    public function login(string $email) : string{
        
        $userSettingRepository = new UserSettingRepository();
        $user = User::where('email', $email)->firstOrFail();

        $token = $user->createToken($user->email. ' '. env('APP_NAME'))->accessToken;
        $userSettingRepository->createDefault($user);
        $this->updateLastLogin($user);

        return $token;
    }

    public function profile(int $userId) : array {
        
        $user = $this->userRepository->show($userId);
        $roles = $this->roleRepository->getUserSimplified($user['id']);

        $user['roles'] = $roles;

        return $user;
    }

    public function register(array $input) : array{

        $data = $this->userRepository->store([
            'email' => $input['email'],
            'password' =>$input['password'],
            'name' => $input['name'],
        ]);

        return $data->toArray();
    }

    private function updateLastLogin(User $user): void{

        $user->last_login_at = now();
        $user->save();
    }

    public function logout(User $user): void
    {

        $user->token()->revoke();
    }
}
