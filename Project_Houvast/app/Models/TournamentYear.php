<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentYear extends Model
{
    use HasFactory;

    protected $primaryKey = 'year_id';
    public $timestamps = false;

    protected $fillable = ['tournament_year'];
}