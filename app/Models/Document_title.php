<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_title extends Model
{
    use HasFactory;
    protected $table = 'document_titles';
    protected $primaryKey = 'document_titles_id';
}
