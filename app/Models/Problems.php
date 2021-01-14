<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problems extends Model
{
    use HasFactory;
    
    protected $fillable =[        
        "gravity",
        "diagnostic_type",
        "diagnostic",
        "pacient_id",
        "medic_id"
    ];
    
    protected $table = 'problems';
}


