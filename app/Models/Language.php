<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'description',
        'value'
    ];

    public $translatable = [
        'description'
    ];
}
