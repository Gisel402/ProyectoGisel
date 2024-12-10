<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user(){
        //Varios comentarios pertenecen un usuario (N)
        return $this->belongsTo(User::class);
    }

    public function project(){
        //Varios comentarios pertenecen un proyecto (N)
        return $this->belongsTo(Project::class);
    }
}
