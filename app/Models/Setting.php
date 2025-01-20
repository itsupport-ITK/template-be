<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Setting",
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="language"
 *   ),
 *   @OA\Property(
 *     property="description",
 *     type="array",
 *     example=
 *              {
 *              "id": "indonesian description",
 *             "en": "english description"
 *           },
 *       @OA\Items(),
 *   ),
 *   @OA\Property(
 *     property="model",
 *     type="string",
 *     example="App\Models\Language"
 *   ),
 * )
 */
class Setting extends Model
{
    use HasFactory, HasTranslations;

    /**
     * constant variable, sama dengan di database
     */
    const LANGUAGE = [
        'id' => 1,
        'name' => 'language',
    ];

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'description',
        'model'
    ];

    protected $hidden = [
        'model',
        'created_at',
        'updated_at'
    ];

    public $translatable = [
        'description'
    ];

    /**
     * cari setting berdasarkan name
     */
    public function scopeGetByName(Builder $query, string $name) : self{
        
        return $query->where('name', $name)->first();
    }

    /**
     * cari value model yang terhubung 
     */
    public function getModelSettingValue(string $value): ?Model{
        
        $model = $this->getModelSetting();

        return $model->where('value', $value)->first();
    }

    /**
     * Ambil instance model
     */
    public function getModelSetting(): Model{
        
        $model = $this->model;

        return new $model;
    }
}
