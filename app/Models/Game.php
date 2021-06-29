<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function getQuestions(){
        $allQuestions = [];

        $questions = [];
        foreach (Card::EYE as $value) {
            $questions['eye@'.$value] = $value;
        }
        $allQuestions['eye'] = $questions;

        $questions = [];
        foreach (Card::SKIN as $value) {
            $questions['skin@'.$value] = $value;
        }
        $allQuestions['skin'] = $questions;

        $questions = [];
        foreach (Card::HAIR as $value) {
            $questions['hair@'.$value] = $value;
        }
        $allQuestions['hair'] = $questions;

        $questions = [];
        foreach (Card::SEX as $value) {
            $questions['sex@'.$value] = $value;
        }
        $allQuestions['sex'] = $questions;

        $questions = [];
        $questions['mustach@1'] = __('mustach');
        $questions['beard@1'] = __('beard');
        $questions['glasses@1'] = __('glasses');
        $allQuestions['other'] = $questions;

        $questions = [];
        $cards = unserialize($this->cards);
        foreach ($cards as $cardId => $card) {
            $questions['id@' . $card->id] = $card->name;
        }
        asort($questions);
        $allQuestions['person'] = $questions;

        return $allQuestions;
    }
}
