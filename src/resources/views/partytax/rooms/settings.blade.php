@extends('partytax.partytax-layout')


@section('specific_content')
    <div class="container">
        <form method="POST" action="{{ route('partytax-room-update') }}">
            @csrf
            <div class="partytax-info__item partytax-info__item_col">
                <h6>
                    Название комнаты
                </h6>
                <input class="form-control" type="text" value="{{ $roomData->name }}" name="roomName">
            </div>
            <hr>
            <div class="partytax-info__item partytax-info__item_col">
                <h6>
                    Ссылка для обзора комнаты
                </h6>
                <input class="form-control" type="text" value="{{ $roomData->link }}" name="roomLink">
            </div>
            <div class="partytax-info__item partytax-info__item_col">
                <h6>
                    Пароль для обзора
                </h6>
                <input class="form-control" type="text" value="{{ $roomData->password }}" name="roomPassword">
            </div>
            <hr>
            <textarea name="roomDescription" class="form-control">{{ $roomData->description }}</textarea>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-primary w-full">Сохранить</button>
            </div>
        </form>
    </div>
@endsection