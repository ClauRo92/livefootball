<?php

namespace App\Http\Controllers;

use App\Game;
use App\Livescore;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GamesController extends Controller
{
    public function index()
    {
        $api = new Game();
        $livescores= $api->getLivescores();
//        dd($livescores);
        $fixtures = $api->getFixtures();
//        dd($fixtures);

        $livescores = Livescore::all();
//        dd($livescores);
        $fixtures = Game::where('time', '>', Carbon::now('Europe/Bucharest')->format('H:i'))->get();
//        dd($fixtures);

        return view('welcome', [
            'livescores' => $livescores,
            'fixtures' => $fixtures,
        ]);
    }

    public function store()
    {

        $game = new Game();
        $game->saveMatches();

//        $game->saveLivescores();



        return redirect('/');
    }

    public function destroy()
    {


        return redirect('/');
    }


}
