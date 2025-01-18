@extends('app')
@section('content')
<div class="poll-container">
    <div class="poll-description">
        <h1 class="poll-title">{{ $poll->title }}</h1>
        <div class="poll-dates">
            <h2>Inicio: {{ $poll->start_date->format('d/m/Y H:i') }}</h2>
            <h2>Fim: {{ $poll->final_date->format('d/m/Y H:i') }}</h2>
        </div>
    </div>
    <form action="{{ route("poll.vote",$poll->id) }}" method="post" class="poll-vote-form">
        @csrf
        @foreach ($poll->options as $option)
            <label for="option{{ $option->id }}" class="poll-option">
                <span for="option{{ $option->id }}">{{ $option->text }} ({{ $option->votes }} votos)</span>
                <input @if(!now()->between($poll->start_date, $poll->final_date)) disabled @endif type="radio" name="option" id="option{{ $option->id }}" value="{{ $option->id }}">
            </label>
        @endforeach
        <button @if(!now()->between($poll->start_date, $poll->final_date)) disabled @endif type="submit">Votar</button>
    </form>
</div>
@endsection
