<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer_type extends Model
{
    use HasFactory;
    protected $table = 'lecturer_types';
    protected $primaryKey = 'lecturer_types_id';
}
