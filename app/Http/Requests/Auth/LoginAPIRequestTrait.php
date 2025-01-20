<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait LoginAPIRequestTrait{

    public function getEmailRule(): array{
        
        return [
            'required',
            'email',
            'exists:users,email'
        ];
    }

    public function getPasswordRule() : array{
        
        return [
            'required',
            'string',
            'max:255', 
            function ($attribute, $value, $fail) {
                
                $user = User::where('email', $this->email)
                            ->first();

                if($user){

                    if(!Hash::check($value, $user->password)){

                        $fail(__('auth.password'));
                    }
                }
            },   
        ];
    }
}