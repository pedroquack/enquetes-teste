@extends('app')
@section('content')
<div class="poll-create">
    <h1>Editar Enquete</h1>
    <form action="{{ route('poll.update',$poll->id) }}" method="post" class="poll-create-form">
        @csrf
        @method('PUT')
        <div class="form-data">
            <div class="form-data-poll">
                <div class="form-group">
                    <label for="title">Titulo da enquete</label>
                    <input type="text" name="title" id="title" value="{{ $poll->title }}">
                    @error('title')
                    <span class="error-message">{{$errors->first('title')}}</span>
                    @enderror
                </div>
                <div class="date-inputs">
                    <div class="form-group">
                        <label for="start_date">Data de Inicio</label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{ $poll->start_date }}">
                        @error('start_date')
                        <span class="error-message">{{$errors->first('start_date')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="final_date">Data de fim</label>
                        <input type="datetime-local" name="final_date" id="final_date" value="{{ $poll->final_date }}">
                        @error('final_date')
                        <span class="error-message">{{$errors->first('final_date')}}</span>
                        @enderror
                    </div>
                </div>
                <button id="add-option" type="button" class="add-option">Adicionar Opção</button>
            </div>
            <div id="form-data-options" class="form-data-options">
                @foreach ($poll->options as $index => $option)
                <div class="form-group">
                    <label for="title">Opção {{ $index+1 }}</label>
                    <input type="text" name="options[]" value="{{ $option->text }}" id="title" class="@if($index+1 > 3) input-new-option @endif">
                    @if ($index+1 > 3)
                        <button type="button" id="remove-option" class="remove-option">Remover</button>
                    @endif
                </div>
                @endforeach
                @error('options.*')
                <span class="error-message">Todos os campos {Opções} devem estar preenchidos</span>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="submit-button">Confirmar</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
