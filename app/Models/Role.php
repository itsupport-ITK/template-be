<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public function scopeFindByName(Builder $query, string $name)
    {
        $query->where('name', $name);
    }

    public function scopeFilter(Builder $query, array $params): void
    {
        $query->when(isset($params['ids']), function($query) use ($params){
            $query->whereIn('id', $params['ids']);
        })->when(isset($params['name']), function($query) use ($params){
            $query->where('name', $params['name']);
        });
    }
}
