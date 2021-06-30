<?php
use App\Models\Card;
$nbCards = unserialize($game->informations);
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                @if ($game->winner == Auth::user()->id)
                    <div class="alert alert-success" role="alert">
                        {{__('Game over. You win.')}}<br/>
                        <a href="{{env('APP_URL')}}/replay/{{$game->id}}">{{__('Play again')}}</a>
                    </div>
                @endif

                @if ($game->winner != Auth::user()->id && !empty($game->winner))
                    <div class="alert alert-danger" role="alert">
                        {{__('Game over. You loose.')}}<br/>
                        {{__('It was')}}
                        @if ($game->player1_id == $game->winner && isset($cards[$game->card1_id])) {{ $cards[$game->card1_id]->name }}. @endif
                        @if ($game->player2_id == $game->winner && isset($cards[$game->card2_id])) {{ $cards[$game->card2_id]->name }}. @endif
                    </div>
                @endif

                @if (!empty($game->player) && $game->player1_id == Auth::user()->id && empty($game->card1_id))
                    {{__('Please, choose a card')}}<br/>
                @endif

                @if (!empty($game->player) && $game->player2_id == Auth::user()->id && empty($game->card2_id))
                        {{__('Please, choose a card')}}<br/>
                @endif

                @if (!empty($game->player) && $game->player != Auth::user()->id)
                        {{__('Wait other player')}}<br/>
                @endif

                @if (!empty($game->card1_id) && !empty($game->card2_id))
                    @if (Auth::user()->id == $game->player1_id)
                        {{__('Your opponent have')}} {{$nbCards[$game->player2_id]}} {{__('card(s).')}}<br/>
                    @else
                        {{__('Your opponent have')}} {{$nbCards[$game->player1_id]}} {{__('card(s).')}}<br/>
                    @endif
                @endif

                @if ($game->player == Auth::user()->id && !empty($game->card1_id) && !empty($game->card2_id) && empty($game->winner))
                        {{__('Please, select a question')}}
                    <form action="{{env('APP_URL')}}/update/{{$game->id}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <select id="question" name="question" >
                            <option value="">-</option>
                            @foreach ($game->getQuestions() as $title => $questions)
                                <optgroup label="{{__($title)}}">
                                    @foreach ($questions as $reponse=>$value)
                                        <option value="{{ $reponse }}">{{ __($value) }} ?</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <input type="submit" value="OK" />
                        <script>
                            document.getElementById('question').focus();
                        </script>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mygrid">
                @foreach ($cards as $card)
                    <div class="card border @if (!$card->isVisible(Auth::user()->id, $game->id)) d-none @endif
                        @if ($card->id == $game->card1_id && Auth::user()->id == $game->player1_id) border-secondary @endif
                        @if ($card->id == $game->card2_id && Auth::user()->id == $game->player2_id) border-primary @endif
                        @if ($game->player1_id == Auth::user()->id) card-primary @endif @if ($game->player2_id == Auth::user()->id) card-secondary @endif
                        ">

                        <div class="card-header">{{ $card->name }}</div>

                        <div class="card-body">
                            <a href="{{env('APP_URL')}}/start/{{$game->id}}/{{$card->id}}">
                                <img style="height:150px;width:150px;" src="/images/cards/{{$card->id}}.png" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if (empty($game->winner))
        <script>
            //Change player -> reload page
            @if (empty(env('PUSHER_APP_ID')))
                window.setInterval(function() {
                    let isFocused = (document.activeElement === document.getElementById('question'));
                    if (!isFocused){
                        jQuery.ajax('{{env('APP_URL')}}/whoplay/{{$game->id}}').done(function(response) {
                            if (response.player == <?php echo Auth::user()->id;?>){
                                window.location.reload();
                            }
                        })
                    }
                },2000)
            @else
                Echo.channel(`game-{{$game->id}}`)
                    .listen('.NextPlayer', (event) => {
                        console.log("public");
                        window.location.reload();
                    });
            @endif
        </script>
    @endif
</div>
@endsection
