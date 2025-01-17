@extends('app')
@section('content')
<div class="poll-container">
    <div>
        <h1>{{ $poll->title }}</h1>
        <div>
            <h2>Inicio: {{ $poll->start_date->format('d/m/Y H:i') }}</h2>
            <h2>Fim: {{ $poll->final_date->format('d/m/Y H:i') }}</h2>
        </div>
    </div>
    <form action="" method="post" class="poll-vote-form">
        @csrf
        @foreach ($poll->options as $option)
            <label for="option{{ $option->id }}" class="poll-option">
                <span for="option{{ $option->id }}">{{ $option->text }} ({{ $option->votes }} votos)</span>
                <input type="radio" name="option" id="option{{ $option->id }}" value="{{ $option->id }}">
            </label>
        @endforeach
        <button type="submit">Votar</button>
    </form>
</div>
@endsection
