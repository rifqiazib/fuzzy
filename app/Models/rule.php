<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rule extends Model
{
    use HasFactory;

    protected $table='rules';
    protected $fillable=[
        'rule',
        'k1',
        'k2',
        'k3',
        'then'
    ];
}
