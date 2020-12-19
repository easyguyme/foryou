<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['description','tags','name'];

    public function project()
    {
        return $this->hasOne(Project::class,'program_id');
    }

}
