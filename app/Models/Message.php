<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages";
    
    protected $fillable = [
        'text',
        'sentby_id',
        'sento_id',
        'publication_id',
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

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}

