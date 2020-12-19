<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = ['exercise_id', 'user_id','created_by','status'];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function program(){
        return $this->belongsTo(Program::class,'user_id');
    }


}
