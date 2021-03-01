<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoComentario extends Model
{
    use HasFactory;
    protected $table = "archivos_chat";
    protected $guarded = [];
}
