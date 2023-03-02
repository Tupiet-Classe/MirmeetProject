<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacio extends Model
{
    use HasFactory;
    
    protected $table = "publications";

    protected $fillable = [
        'ref_swarm',
        'user_id',
        'publication_id',
        'hidden',
    ];
}
