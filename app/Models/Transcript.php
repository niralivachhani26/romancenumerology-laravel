<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;

    public function getlovepathnumber(){
        return $this->hasOne(LovePathNumber::class, 'id', 'love_path_number');
    }

    public function getheartdesiernumber(){
        return $this->hasOne(HeartDesierNumber::class, 'id', 'heart_desier_number');
    }
    public function getlovedesirenumber(){
        return $this->hasOne(LoveDesierNumber::class, 'id', 'love_Desire_number');
    }
}
