<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bracket extends Model
{
    use HasFactory;

    protected $primaryKey = 'bracket_id';
    public $timestamps = false;

    protected $fillable = [
        'bracket_name',
        'weight_class',
        'location',
        'age',
    ];
}
