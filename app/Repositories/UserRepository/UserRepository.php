<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
     /**
    * List of users
    */
   public function list(array $params = []): Collection
   {

       $usersData = $this->getData($params)->get();

       return $usersData;
   }
   
   public function show(int $userId): array{
       
       $user = User::findOrFail($userId);
       
       return $user->toArray();
   }

   public function store(array $params): User
   {
       $params['password'] = Hash::make($params['password']);
       $user = User::create($params);
       $this->updateUserRole($user);

       return $user;
   }

   public function update(User $user, array $params): User
   {
       $user->update($params);
       $this->updateUserRole($user);
     
       return $user;
   }

   public function delete(User $user): void
   {
       $user->delete();
   }

   private function getData(array $params = []): Builder
   {
       $usersData = User::filter($params)->with('roles');

       return $usersData;
   }

   private function updateUserRole(User $user) : void {

    if(isset($params['role_ids'])){
        $user->roles()->sync($params['role_ids']);
    }

   }
}
