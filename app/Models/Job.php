<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends   Model
{

    // this tells laravel that this model is associated with the 'list_items' table in the database
    protected $table = 'list_items';
    
    // for security, when data in being assigned 
    protected $fillable = [
        'title',
        'department',
        'description',
        'skills',
        'eligibility_rules',
        'scoring_weights',
        'deadline',
    ];
}
