<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $primaryKey = 'club_id';
    public $timestamps = false;

    protected $fillable = [
        'club_name',
        'location',
        'country',
    ];
}

