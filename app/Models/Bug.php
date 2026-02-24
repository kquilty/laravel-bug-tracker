<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    /** @use HasFactory<\Database\Factories\BugFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'days_old',
    ];
}
