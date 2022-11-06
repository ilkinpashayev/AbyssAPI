<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesModel extends Model
{
    use HasFactory;
    protected $table = "files";

    protected $fillable=[
        'name', 
        'description',
        'type',
        'datecreated'
    ];

    public $timestamps = false;
}
