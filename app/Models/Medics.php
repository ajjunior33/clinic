<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medics extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'crm',
        'function',
        'active'
    ];
    protected $table = 'medics';
}
