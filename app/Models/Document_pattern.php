<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_pattern extends Model
{
    use HasFactory;
    protected $table = 'document_patterns';
    protected $primaryKey = 'document_patterns_id';
}
