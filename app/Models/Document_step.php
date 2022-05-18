<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_step extends Model
{
    use HasFactory;
    protected $table = 'document_steps';
    protected $primaryKey = 'document_steps_id';

}
