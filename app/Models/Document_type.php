<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    use HasFactory;
    protected $table = 'document_types';
    protected $primaryKey = 'document_types_id';
}
