<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @OA\Schema(
 *   schema="User",
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     example="example@itk.ac.id"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Test Name"
 *   ),
 *   @OA\Property(
 *     property="password",
 *     type="string",
 *     example="password124!"
 *   ),
 * )
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * filter
     * @param array $params
     */
    public function scopeFilter(Builder $query, array $params)
    {

        $query->when(!empty($params['keyword']), function (Builder $query) use ($params) {

            $keyword = $params['keyword'];

            $query->where('name', 'like', "%$keyword%");
        });
    }

    public function settings(){
        
        return $this->belongsToMany(Setting::class, 'user_settings', 'user_id', 'setting_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role)
    {

        if ($this->roles->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function hasAnyRoles($roles)
    {

        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }

        return false;
    }
}
