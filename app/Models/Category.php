<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'description',
        'active'
    ];
    protected $casts = [
        'id' => 'string',
        'active' => 'boolean',
        'deleted_at' => 'datetime',
    ];
}
