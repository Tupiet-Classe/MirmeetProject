<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{
    use HasFactory;

    protected $table = "share";

    protected $fillable = [
        'date',
        'publication_id'
    ];
    
    public function notification()
    {
        return $this->belongsTo(Notifcation::class);
    }
    public function publlication()
    {
        return $this->belongsTo(Publication::class);
    }

}