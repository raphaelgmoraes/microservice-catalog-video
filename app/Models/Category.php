<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
    ];

    protected $casts = [
        'id' => 'string',
        'active' => 'boolean',
        'deleted_at' => 'datetime',
    ];
}
