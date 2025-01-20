<?php

namespace App\Repositories\RoleRepository;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class RoleRepository extends BaseRepository
{

    public function list(array $params = []): Collection
    {

        $rolesData = $this->getData($params)->get();

        return $rolesData;
    }

    public function getUserSimplified(int $userId) : array{
        
        $user = User::findOrFail($userId);
        $roles = $user->roles->pluck('name')->toArray();

        return $roles;
    }

    private function getData(array $params = []): Builder
    {
        $rolesData = Role::filter($params);

        return $rolesData;
    }
}
