<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Card extends Model
{
    public $timestamps = false;
    public const SEX = ['man','woman'];
    public const HAIR = ["dark blond","black","white","blond","red","bald"];
    public const EYE = ["blue","green","black","brown","grey"];
    public const SKIN = ["white","black"];


    public function isVisible($playerId, $gameId){
        $game = Game::findOrFail($gameId);
        $cards = unserialize($game->cards);

        foreach ($cards[$this->id] as $attribute=>$value){
            $this->$attribute = $value;
        }

        if ($playerId == $game->player1_id){
            return $this->visible_player1;
        }
        if ($playerId == $game->player2_id){
            return $this->visible_player2;
        }
    }

}
