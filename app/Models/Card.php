<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Card extends Model
{
    public $timestamps = false;
    public const SEX = ['man','woman'];
    public const HAIR = ["hair_dark blond","hair_black","hair_white","hair_blond","hair_red","hair_bald"];
    public const EYE = ["eye_blue","eye_green","eye_black","eye_brown","eye_grey"];
    public const SKIN = ["skin_white","skin_black"];


    public function isVisible($game, $playerId, $gameId){
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
