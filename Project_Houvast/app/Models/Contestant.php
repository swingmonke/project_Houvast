<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'registered_weight',
        'date_of_birth',
        'profile_picture',
        'club_id',
        'is_present',
        'is_weighed',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Return the full name (first, infix, last)
     */
    public function getNameAttribute(): string
    {
        $parts = array_filter([
            $this->first_name,
            $this->infix,
            $this->last_name,
        ]);

        return implode(' ', $parts);
    }

    /**
     * Calculate age from date_of_birth
     */
    public function getAgeAttribute(): ?int
    {
        if (empty($this->date_of_birth)) {
            return null;
        }

        $dob = $this->date_of_birth instanceof Carbon
            ? $this->date_of_birth
            : Carbon::parse($this->date_of_birth);

        return $dob->age;
    }

    /**
     * Return the club name when accessing $contestant->club
     */
    public function getClubAttribute(): ?string
    {
        // Avoid recursion by fetching relation directly
        $club = $this->getRelationValue('club') ?: $this->club()->first();

        return $club ? $club->club_name : null;
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}