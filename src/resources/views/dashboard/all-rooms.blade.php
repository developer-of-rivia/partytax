@extends('dashboard.layouts.dashboard-layout')


@section('specific_content')
    <div class="container">
        <div class="partytax__buttons">
            <a href="{{ route('dashboard.create-page') }}" class="partytax__button mb-2">
                Создать комнату
            </a>
            <a href="{{ route('dashboard.subscribers.add-page') }}" class="partytax__button">
                Подписаться на комнату
            </a>
        </div>
        <div class="partytax__rooms">
            <h5 class="mb-3">Я создатель в этих комнатах:</h5>
            <ul class="list-group">
                @foreach($roomsUserCreator as $room)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="me-auto">
                            <div class="fw-bold me-2">{{ $room->name }}</div>
                        </div>
                        @if(session()->get('current_room') == $room->id)
                            <span class="badge text-bg-success rounded-pill">
                                Активно
                            </span>
                        @else
                            <a href="{{ route('dashboard.room.change', $room->id) }}" class="badge text-bg-primary rounded-pill ml-auto">
                                Переключиться
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="partytax__rooms mt-5">
            <h5>Я подписан на этих комнаты:</h5>
                <ul class="list-group">
                    @foreach($roomsUserSubscriber as $room)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold me-2">{{ $room->name }}</div>
                                <form action="{{ route('dashboard.subscribers.remove') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="text" value="{{ $room->id }}" name="roomID" hidden>
                                    <button type="submit" class="badge text-bg-danger rounded-pill ml-auto mt-1" style="border: none">
                                        отписка
                                    </button>
                                </form>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                @if(session()->get('current_room') == $room->id)
                                    <span class="badge text-bg-success rounded-pill">
                                        Активно
                                    </span>
                                    @else
                                    <a href="{{ route('dashboard.room.change', $room->id) }}" class="badge text-bg-primary rounded-pill ml-auto">
                                        Переключиться
                                    </a>
                                @endif
                            </div>
                        </li>

                        {{-- <div class="partytax__room-item">
                            <div class="partytax__room-item-name">
                                {{ $room->name }}
                            </div>
                            @if(session()->get('current_room') == $room->id)
                                <div class="ml-auto badge text-bg-success">
                                    Активно
                                </div>
                            @else
                                <a href="{{ route('dashboard.room.change', $room->id) }}" class="btn btn-link btn-sm ml-auto">
                                    Переключиться
                                </a>
                            @endif
                            <form action="{{ route('dashboard.subscribers.remove') }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="text" value="{{ $room->id }}" name="roomID" hidden>
                                <button type="submit" class="unsub-btn">
                                    <span>
                                        отписка
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div> --}}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
