<?php

namespace App\Repositories;

use App\Services\ApiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BaseRepository{

    public $client;

    /**
     * client API getter
     * @param  bool  $isWithToken
     */
    public function client(
        bool $isWithToken = true
    )
    {
        $user = Auth::user();

        if($isWithToken == true && $user == null){
            abort(401, 'Unauthenticated');
        }
        $this->client = new ApiService($isWithToken, $user->id ?? null);

        return $this->client;
    }
}