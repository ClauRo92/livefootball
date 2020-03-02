<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livescore extends Model
{
    protected $fillable = [
        'league_name', 'home_id', 'status', 'home_name', 'id', 'competition_id', 'away_id', 'ht_score', 'added',
        'score', 'competition_name', 'fixture_id', 'away_name', 'events', 'scheduled', 'et_score', 'league_id',
        'location', 'time', 'last_changed', 'ft_score', 'outcomes_half_time', 'outcomes_full_time', 'outcomes_extra_time',
        'created_at', 'updated_at'
        ];


}
