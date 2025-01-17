@extends('app')
@section('content')
    <div>
        @if ($polls->count() >= 0)
            <h1 class="section-title">Ainda não existem enquetes! Que tal criar uma?</h1>
        @else
            <h1 class="section-title">Enquetes</h1>
            @foreach ($polls as $poll)

            @endforeach
        @endif
    </div>
@endsection
