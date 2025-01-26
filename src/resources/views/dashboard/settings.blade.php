@extends('dashboard.layouts.dashboard-layout')


@section('specific_content')
    <div class="container">
        <form method="POST" action="{{ route('dashboard.room.update') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Название комнаты</label>
                <input type="text" class="form-control form-control-sm" value="{{ $roomData->name }}" name="roomName">
            </div>
            <div class="mb-4">
                <label class="form-label">Ссылка для обзора комнаты</label>
                <input type="text" class="form-control form-control-sm" value="{{ $roomData->link }}" name="roomLink">
            </div>
            <div class="mb-4">
                <label class="form-label">Пароль для обзора</label>
                <input type="text" class="form-control form-control-sm" value="{{ $roomData->password }}" name="roomPassword">
            </div>
            <div class="mb-4">
                <label class="form-label">Описание комнаты</label>
                <textarea class="form-control form-control-sm" name="roomDescription">{{ $roomData->description }}</textarea>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary w-full">Сохранить</button>
            </div>
        </form>
    </div>
@endsection