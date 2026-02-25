<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'position',
        'team_id', // FK
    ];
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
