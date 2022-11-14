<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "candidates";
    protected $fillable =[
        'nama',
        'penghasilan',
        'jumlah_tanggungan',
        'daya_listrik'
    ];
}
