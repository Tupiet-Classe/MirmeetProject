<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = "likes";

    protected $fillable = [
        'date',
        'publication_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}
