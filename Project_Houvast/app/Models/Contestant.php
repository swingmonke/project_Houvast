<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $primaryKey = 'contestant_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'infix',
        'weight',
        'date_of_birth',
        'profile_picture',
        'club_id',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}