<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criteria;

class Variable extends Model
{
    use HasFactory;
    protected $table='variables';
    protected $fillable=[
        'name'
    ];

    public function hasCriterias()
    {
        return $this->hasMany(Criteria::class,'variable_id', 'id' );

}
}