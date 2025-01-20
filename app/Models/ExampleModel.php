<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    use HasFactory;

    /**
     * definisikan nama tabel
     *  protected $table = 'bahan_kajian';

        definisikan field di dalam tabel
        protected $fillable = [
            'number',
            'name',
            'user_id',
            'year'
        ];

        definisikan field yang harus ditranslate
        public $translatable = [
            'name'
        ];


        penggunaan scope untuk filter dan lain2
        public function scopeFilter(Builder $query, array $params): void
        {
            $query->when(!empty($params['keyword']), function ($query) use ($params) {
                $query->where('name', 'like' , "%".$params['keyword']."%");
            })
        }
     */
}
