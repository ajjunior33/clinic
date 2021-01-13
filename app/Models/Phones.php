<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    use HasFactory;
    protected $fillable =[
        "owner", "number", "type", "prefixed", "main","pacient_id"
    ];
    
    protected $table = 'phones';
}
