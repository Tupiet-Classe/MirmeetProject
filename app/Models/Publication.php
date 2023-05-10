<?php

namespace App\Models;
use App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    
    protected $table = "publications";

    protected $fillable = [
        'ref_swarm',
        'user_id',
        'publication_id',
        'hidden',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
