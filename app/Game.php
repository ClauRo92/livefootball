<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeZone;
use DateTime;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Game extends Model
{
    protected $_baseUrl = "https://livescore-api.com/api-client/";
    protected $fillable = [
        '_id', 'date', 'time', 'round', 'home_name', 'away_name',
        'location', 'league_id', 'competition_id', 'home_id', 'away_id',
        'competition_name', 'created_at', 'updated_at',
        ];

    protected $timezone = 'Europe/Bucharest';

    public function buildUrl($endpoint) {
        $key = config('services.live_score.key');
        $secret = config('services.live_score.secret');
        return $this->_baseUrl . $endpoint . "key=".$key."&secret=" . $secret;
    }

    public function getLivescores() {
        $url = $this->buildUrl('scores/live.json?');
        $json = file_get_contents($url);
        $livescores = json_decode($json, true);
        return $livescores['data']['match'];
    }

    public function getFixtures() {
        $url = $this->buildUrl('fixtures/matches.json?');
        $json = file_get_contents($url);
        $fixtures = json_decode($json, true);
        return $fixtures['data']['fixtures'];
    }
    public function saveMatches()
    {
        $matches = $this->getFixtures();

        collect($matches)
            ->each(function ($match, $key) {
                Game::firstOrCreate([
                    '_id' => $match['id'],
                    'date' => $match['date'],
                    'time' => $this->convert($match['time'], $this->timezone),
                    'round' => $match['round'],
                    'home_name' => $match['home_name'],
                    'away_name' => $match['away_name'],
                    'location' => $match['location'],
                    'league_id' => $match['league_id'],
                    'competition_id' => $match['competition_id'],
                    'home_id' => $match['home_id'],
                    'away_id' => $match['away_id'],
                    'competition_name' => $match['competition']['name'],
//                    'league_name' => $match['league']['name'],
//                    'league_country_id' => $match['league']['country_id'],
                    'created_at'=> Carbon::now($this->timezone),
                    'updated_at'=> Carbon::now($this->timezone),
                ]);
            });

    }
    public function saveLivescores()
    {
        $livescores = $this->getLivescores();

        collect($livescores)
            ->each(function ($livescore){
                Livescore::updateOrCreate([
                    'league_name' => $livescore['league_name'],
                    'home_id' => $livescore['home_id'],
                    'home_name' => $livescore['home_name'],
                    'id' => $livescore['id'],
                    'competition_id' => $livescore['competition_id'],
                    'away_id' => $livescore['away_id'],
                    'added' => $livescore['added'],
                    'competition_name' => $livescore['competition_name'],
                    'fixture_id' => $livescore['fixture_id'],
                    'away_name' => $livescore['away_name'],
                    'events' => $livescore['events'],
                    'scheduled' => $this->convert($livescore['scheduled'], $this->timezone),
                    'league_id' => $livescore['league_id'],
                    'location' => $livescore['location'],
                    'created_at'=> Carbon::now($this->timezone),

                    ],

                    [
                    'status' => $livescore['status'],
                    'ht_score' => $livescore['ht_score'],
                    'score' => $livescore['score'],
                    'et_score' => $livescore['et_score'],
                    'time' => $livescore['time'],
                    'last_changed' => $livescore['last_changed'],
                    'ft_score' => $livescore['ft_score'],
                    'outcomes_half_time' => $livescore['outcomes']['half_time'],
                    'outcomes_full_time' => $livescore['outcomes']['full_time'],
                    'outcomes_extra_time' => $livescore['outcomes']['extra_time'],
                    'updated_at'=> Carbon::now($this->timezone),

                ]);
            });
    }







    public static function convert($time, $timezone) {

        $date = new DateTime(date('Y-m-d ') . $time , new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($timezone));
        $time= $date->format('H:i');
        return $time;
    }
}
