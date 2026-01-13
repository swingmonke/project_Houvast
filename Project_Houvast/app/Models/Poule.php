<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poule extends Model
{
    use HasFactory;

    protected $primaryKey = 'poule_id';
    public $timestamps = false;

    protected $fillable = [
        'poule_name',
        'weight_class',
        'location',
        'poule_size',
        'age',
    ];
}
