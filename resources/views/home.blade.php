@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                <meta http-equiv="refresh" content="10;">
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <a href="/create">{{__('Create a game')}}</a>

                    @if (count($games)>0)
                        <h2>{{__('Join a game')}}</h2>
                        <ul>
                            @foreach ($games as $game)
                                <li>
                                    <a href="/game/{{ $game->id }}">{{ $game->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if (count($mygames)>0)
                        <h2>{{__('My games')}}</h2>
                        <ul>
                            @foreach ($mygames as $game)
                            <li>
                                <a href="/game/{{ $game->id }}">{{ $game->name }}</a>
                                <a href="/remove/{{ $game->id }}">Remove</a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
