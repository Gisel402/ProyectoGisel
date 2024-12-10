<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function files(){
        //Un proyecto puede tener muchos archivos (1)
        return $this->hasMany(File::class);
    }

    public function comments(){
        //Un proyecto puede tener muchos comentarios (1)
        return $this->hasMany(Comment::class);
    }

    public function user(){
        //Varios proyectos pertenecen un usuario (N)
        return $this->belongsTo(User::class);
    }

}
