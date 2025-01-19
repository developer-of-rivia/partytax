@extends('partytax.partytax-layout')


@section('specific_content')
    <div class="container">
        <div class="partytax-info__item">
            <h6>
                Название комнаты
            </h6>
            <span class="badge text-bg-success">
                {{ $roomData->name }}
            </span>
        </div>
        <div class="partytax-info__item">
            <h6>
                Количество участников
            </h6>
            <span class="badge rounded-pill text-bg-primary">
                {{ $membersCount }}
            </span>
        </div>
        <div class="partytax-info__item">
            <h6>
                Создатель комнаты
            </h6>
            <span class="badge rounded-pill text-bg-danger">
                Юрий Вёрстка
            </span>
        </div>
        <hr>
        <div class="partytax-info__item">
            <h6>
                Ссылка для обзора комнаты
            </h6>
            <a href="{{ session()->get('currentRoom_link') }}" class="link">
                {{ $roomData->link }}
            </a>
        </div>
        <div class="partytax-info__item">
            <h6>
                Пароль для обзора
            </h6>
            <a href="{{ session()->get('currentRoom_link') }}" class="link">
                {{ $roomData->password }}
            </a>
        </div>
        <hr>
        <div class="alert alert-primary" role="alert">
            {{ $roomData->description }}
        </div>
        <div class="mt-auto text-center">
            <a href="{{ route('partytax-room-settings') }}" class="link link-danger">
                Редактировать страницу
            </a>
        </div>
    </div>
@endsection