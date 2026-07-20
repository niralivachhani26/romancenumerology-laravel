<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function getTranscript() {
        return $this->belongsTo(Transcript::class, 'transcript_id');
    }
}
