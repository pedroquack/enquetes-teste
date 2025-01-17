@extends('app')
@section('content')
    <div class="polls-index">
        <a href="{{ route('poll.create') }}" class="create-poll-link">CRIAR ENQUETE</a>
        @if ($polls->count() <= 0)
            <h1 class="section-title">Ainda não existem enquetes! Que tal criar uma?</h1>
        @else
            <div class="polls">
                @foreach ($polls as $poll)
                <div class="poll">
                    <div class="poll-status @if(now()->between($poll->start_date, $poll->final_date)) poll-open @endif">
                        @if(now()->between($poll->start_date, $poll->final_date))
                            Em Andamento!
                        @elseif(now() < $poll->start_date)
                            Não iniciada!
                        @else
                            Finalizada!
                        @endif
                    </div>
                    <div class="poll-header">
                        <h2 class="poll-title">{{ $poll->title }}</h2>
                        <div>
                            <h3 class="poll-date">Inicio: {{ $poll->start_date->format('d/m/Y H:i') }}</h3>
                            <h3 class="poll-date">Fim: {{ $poll->final_date->format('d/m/Y H:i') }}</h3>
                        </div>
                    </div>
                    <a href="{{ route('poll.show',$poll->id) }}" class="poll-button">Acessar enquete</a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
