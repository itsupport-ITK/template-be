<?php

namespace App\Repositories\TokenRepository;

use App\Models\ApiAccessToken;
use App\Models\GerbangAccessToken;
use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Managing token related to api
 */
class TokenRepository extends BaseRepository
{
    /**
     * get api gerbang token from database
     */
    public function get(int $userId) :?string {
        
        $token = null;
        
        $apiAccessToken = ApiAccessToken::where('user_id', $userId)->latest()->first();

        if(isset($apiAccessToken)){

            $token = $apiAccessToken->token;
        }

        return $token;
    }
    
    /**
     * get token from api
     */
    public function getFromApi(int $userId) : string{
        
        $token = null;

        //isi dengan url service
        $response = $this->client($isWithToken = false, $userId)->post('token', [
            'email' => config('api.username'),
            'password' => config('api.password'),
            'token_name' => config('api.token.gerbang')
        ]);
        
        if(isset($response['status']) && $response['status'] == true){
            $token = $response['data'];
        }

        return $token;
    }

    /**
     * get token from api and set token to database
     */
    public function getAndStoreTokenToDatabase(int $apiAccessTokenTypeId, int $userId): string{
        
        $token = $this->getFromApi($userId);

        $apiToken = $this->store([
            'api_access_token_type_id' => $apiAccessTokenTypeId,
            'user_id' => $userId,
            'token' => $token,
        ]);

        return $apiToken->token;
    }

    /** 
     * store token gerbang to database
    */
    public function store(array $input) : ApiAccessToken{
        
        $apiAccessToken = ApiAccessToken::create($input);

        return $apiAccessToken;
    }

    public function revoke(int $userId): void{
        
        ApiAccessToken::where('user_id', $userId)->latest()->delete();
    }
}
