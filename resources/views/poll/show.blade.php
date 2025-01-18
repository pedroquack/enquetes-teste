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
                <span for="option{{ $option->id }}">{{ $option->text }} <small id="votes-{{ $option->id }}">({{ $option->votes }} votos)</small></span>
                <input @if(!now()->between($poll->start_date, $poll->final_date)) disabled @endif type="radio" name="option" id="option{{ $option->id }}" value="{{ $option->id }}">
            </label>
        @endforeach
        @if($poll->final_date > now())
            <button @if(!now()->between($poll->start_date, $poll->final_date)) disabled @endif type="submit">Votar</button>
        @endif
    </form>
    <div class="poll-actions">
        <form action="{{ route('poll.destroy',$poll->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-poll">Excluir Enquete</button>
        </form>
        <a href="{{ route('poll.edit',$poll->id) }}" class="edit-poll">Editar enquete</a>
    </div>
</div>
<script>
    Pusher.logToConsole = false;

    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: 'sa1',
        encrypted: true
    });

    var channel = pusher.subscribe('update_votes_channel');
    channel.bind('App\\Events\\UpdateVotes', function(data) {
        const option = data.option;
        const optionInput = document.getElementById(`votes-${option.id}`);
        optionInput.textContent = `(${option.votes} votos)`
    });
</script>
@endsection
