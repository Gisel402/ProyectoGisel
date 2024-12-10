<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    public function comments(){
        //Un usuario puede tener muchos comentarios (1)
        return $this->hasMany(Comment::class);
    }

    public function projects(){
        //Un usuario puede tener muchos proyectos (1)
        return $this->hasMany(Project::class);
    }
}
