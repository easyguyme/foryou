<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['exercise_id','program_id','created_by'];

    public function program() {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function exercise(){
        return $this->hasMany(Exercise::class,'id');
    }
}
