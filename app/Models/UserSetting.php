<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="UserSettings",
 *   @OA\Property(
 *     property="user_id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="setting_id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="value",
 *     type="string",
 *     example="IO"
 *   ),
 * )
 */
class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'setting_id',
        'value',
    ];
}
