@extends('partytax.partytax-layout')


@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <div class="partytax__buttons">
                <a href="{{ route('partytax-rooms-create-page') }}" class="partytax__button mb-2">
                    Создать комнату
                </a>
                <a href="{{ route('partytax-rooms-join-page') }}" class="partytax__button">
                    Отслеживать комнату
                </a>
            </div>
            <div class="partytax__rooms">
                <h3>Я создатель в этих комнатах:</h3>
                <div class="partytax__rooms-list">
                    @foreach($roomsUserCreator as $room)
                        <div class="partytax__room-item">
                            <div class="partytax__room-item-name">
                                {{ $room->name }}
                            </div>
                            @if(session()->get('current_room') == $room->id)
                                <div class="ml-auto partytax__room-item-active">
                                    Активно
                                </div>
                            @else
                                <a href="{{ route('partytax-room-change', $room->id) }}" class="partytax__room-item-status ml-auto">
                                    Переключиться
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="partytax__rooms">
                <h3>Я отлеживаю:</h3>
                <div class="partytax__rooms-list">
                    @foreach($roomsUserMember as $room)
                        <div class="partytax__room-item">
                            <div class="partytax__room-item-name">
                                {{ $room->name }}
                            </div>
                            @if(session()->get('current_room') == $room->id)
                                <div class="ml-auto partytax__room-item-active">
                                    Активно
                                </div>
                            @else
                                <a href="http://127.0.0.1:8000/partytax/room/change/{{$room->id}}" class="partytax__room-item-status ml-auto">
                                    Переключиться
                                </a>
                            @endif
                            <a href="http://127.0.0.1:8000/partytax/room/forget/{{$room->id}}" class="partytax__room-item-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Не отслеживать
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
