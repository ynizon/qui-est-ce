<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Game;
use Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function start($id, $cardId)
    {
        $game = Game::findOrFail($id);
        if (empty($game->player) || empty($game->card1_id) || empty($game->card2_id)){
            if ($game->player1_id == Auth::user()->id){
                $game->card1_id = $cardId;
            }else{
                $game->card2_id = $cardId;
            }
            $game->save();
        }

        return redirect("/game/".$game->id);
    }

    public function replay($id, Request $request){
        $game = Game::findOrFail($id);
        if ($game->winner == Auth::user()->id){
            $players = [$game->player1_id, $game->player2_id];
            shuffle($players);
            $game->player = $players[0];

            $this->init($game);
        }
        return redirect('/game/'.$game->id);
    }

    public function game($id, Request $request){
        $game = Game::findOrFail($id);

        if (!empty($game->winner) && $request->input('end') != 1){
            if ($game->winner == Auth::user()->id) {
                return redirect("/game/".$game->id."?end=1")->withStatus(__("Game over. You win."));
            }else{
                return redirect("/game/".$game->id."?end=1")->withError(__("Game over. You loose."));
            }
        }

        $cards = unserialize($game->cards);

        if (empty($game->player2_id) && $game->player1_id != Auth::user()->id){
            $game->player2_id = Auth::user()->id;
            $players = [$game->player1_id, $game->player2_id];
            shuffle($players);
            $game->player = $players[0];
            $game->informations = serialize([$game->player1_id => count($cards), $game->player2_id => count($cards)]);
            $game->save();
        }

        return view('game',compact('cards','game'));
    }

    public function create(){
        $game = new Game();
        $game->name = date("Y-m-d H:i:s");
        $game->created_at = date("Y-m-d H:i:s");
        $game->player1_id = Auth::user()->id;
        $game->player2_id = null;
        $game->player = 0;
        $this->init($game);

        return redirect("/game/".$game->id);
    }

    private function init($game){
        $game->card1_id = null;
        $game->card2_id = null;
        $game->cards = serialize([]);
        $game->winner = 0;

        $cards = Card::all();
        $info = [];
        foreach ($cards as $card){
            $card->game_id = $game->id;
            $card->visible_player1 = 1;
            $card->visible_player2 = 1;
            $info[$card->id] = $card;
        }

        $game->informations = serialize([$game->player1_id => count($cards), $game->player2_id => count($cards)]);
        $game->cards = serialize($info);
        $game->save();
    }

    public function update($id, Request $request){
        $game = Game::findOrFail($id);
        $cards = unserialize($game->cards);
        if (!empty($request->input('question')) && Auth::user()->id == $game->player){
            $questions = explode('@',$request->input('question'));
            $attribute = $questions[0];
            $value = $questions[1];

            $cardRef = null;
            if (Auth::user()->id == $game->player1_id){
                $cardRef = $cards[$game->card2_id];
            }else{
                $cardRef = $cards[$game->card1_id];
            }
            $values = [];
            if ($cardRef->$attribute == $value){
                //Prendre toutes les autres valeurs de l'attribut
                switch ($attribute){
                    case 'eye':
                        foreach (Card::EYE as $v){
                            if ($v != $value){
                                $values[]= $v;
                            }
                        }
                        break;

                    case 'skin':
                        foreach (Card::SKIN as $v){
                            if ($v != $value){
                                $values[]= $v;
                            }
                        }
                        break;

                    case 'hair':
                        foreach (Card::HAIR as $v){
                            if ($v != $value){
                                $values[]= $v;
                            }
                        }
                        break;

                    case 'sex':
                        foreach (Card::SEX as $v){
                            if ($v != $value){
                                $values[]= $v;
                            }
                        }
                    break;

                    case 'id':
                        foreach (Card::all() as $v){
                            if ($v->id != $value){
                                $values[]= $v->id;
                            }
                        }
                        break;

                    default:
                        if ($value == 1){
                            $values = [0];
                        }else{
                            $values = [1];
                        }

                        break;
                }
            }else{
                $values = [$value];
            }

            $newCards = [];
            foreach ($cards as $card){
                if (in_array($card->$attribute, $values)){
                    if ($game->player1_id == Auth::user()->id){
                        $card->visible_player1 = false;
                    }
                    if ($game->player2_id == Auth::user()->id){
                        $card->visible_player2 = false;
                    }
                }
                $newCards[$card->id] = $card;
            }

            $game->cards = serialize($newCards);

            if ($game->player1_id == $game->player) {
                $game->player = $game->player2_id;
            }else{
                $game->player = $game->player1_id;
            }
            $game->save();

            $nbVisibleCards1 = 0;
            $nbVisibleCards2 = 0;
            foreach ($newCards as $card){
                if ($card->isVisible($game->player1_id, $game->id)){
                    $nbVisibleCards1++;
                }
                if ($card->isVisible($game->player2_id, $game->id)){
                    $nbVisibleCards2++;
                }
            }

            $game->informations = serialize([$game->player1_id => $nbVisibleCards1, $game->player2_id => $nbVisibleCards2]);
            $game->save();

            if (Auth::user()->id == $game->player1_id) {
                $nbVisibleCards = $nbVisibleCards1;
            }else{
                $nbVisibleCards = $nbVisibleCards2;
            }

            if ($nbVisibleCards == 1 && empty($game->winner)){
                if ($game->player2_id == Auth::user()->id){
                    $game->winner = $game->player2_id;
                }else{
                    $game->winner = $game->player1_id;
                }
                $game->save();
            }
        }

        return redirect("/game/".$game->id);
    }

    public function delete($id){
        $game = Game::findOrFail($id);
        if ($game->player1_id == Auth::user()->id){
            $game->delete();
        }
        return redirect('/home');
    }
}
