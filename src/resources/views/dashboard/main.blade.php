@extends('dashboard.layouts.dashboard-layout')


@section('specific_content')
    <div class="container main">
        <div class="dashboard-info__item">
            <h6>
                Название комнаты:
            </h6>
            <span class="badge text-bg-success">
                {{ $roomData->name }}
            </span>
        </div>
        <div class="dashboard-info__item">
            <h6>
                Количество участников:
            </h6>
            <span class="badge rounded-pill text-bg-warning">
                {{ $membersCount }}
            </span>
        </div>
        <div class="dashboard-info__item">
            <h6>
                Создатель комнаты:
            </h6>
            <span class="badge rounded-pill text-bg-danger">
                {{ Auth::user()->name }}
                {{ Auth::user()->nickname }}
            </span>
        </div>
        <hr>
        <div class="dashboard-info__item">
            <h6>
                Ссылка для обзора комнаты:
            </h6>
            <a href="{{ session()->get('currentRoom_link') }}" class="link dashboard-info__room-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/></svg>
                <span>
                    {{ $roomData->link }}
                </span>
            </a>
        </div>
        <div class="dashboard-info__item">
            <h6>
                Пароль для обзора:
            </h6>
            <a href="{{ session()->get('currentRoom_link') }}" class="link dashboard-info__room-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M364.2 83.8c-24.4-24.4-64-24.4-88.4 0l-184 184c-42.1 42.1-42.1 110.3 0 152.4s110.3 42.1 152.4 0l152-152c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-152 152c-64 64-167.6 64-231.6 0s-64-167.6 0-231.6l184-184c46.3-46.3 121.3-46.3 167.6 0s46.3 121.3 0 167.6l-176 176c-28.6 28.6-75 28.6-103.6 0s-28.6-75 0-103.6l144-144c10.9-10.9 28.7-10.9 39.6 0s10.9 28.7 0 39.6l-144 144c-6.7 6.7-6.7 17.7 0 24.4s17.7 6.7 24.4 0l176-176c24.4-24.4 24.4-64 0-88.4z"/></svg>
                <span>
                    {{ $roomData->password }}
                </span>
            </a>
        </div>
        <hr>
        <div class="alert alert-primary" role="alert">
            {{ $roomData->description }}
        </div>
        @if(session()->get('canIEditThisRoom'))
            <div class="main__button-area">
                <a href="{{ route('dashboard.room.settings') }}" class="link link-danger">
                    Редактировать страницу
                </a>
            </div>
        @endif
    </div>
@endsection