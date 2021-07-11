<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DNA extends Model
{
    use HasFactory;

    protected $table = 'dnas';

    protected $fillable = ['dnaSecuence', 'isForceUser'];
    
}
