<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages";
    
    protected $fillable = [
        'sentby_id',
        'sento_id',
        'text',
        'hidden',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sentby_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'sento_id');
    }
}
