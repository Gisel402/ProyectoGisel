<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function project(){
        //Varios archivos pertenecen un proyecto (N)
        return $this->belongsTo(Project::class);
    }
}
