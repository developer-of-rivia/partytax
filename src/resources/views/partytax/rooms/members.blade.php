@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="container">
        <a href="{{ route('partytax-room-mebmers-add-page') }}" class="partytax__btn btn btn-primary">
            Добавить участника
        </a>
        <div class="partytax__members-list">

            @foreach($members as $member)
                <div class="partytax__member">
                    <div class="partytax__member-face">
                        <div class="partytax__member-name">
                            {{ $member->name }}
                        </div>
                    </div>
                    <div class="partytax__member-buttons">
                        <a href="{{ route('partytax-room-mebmers-remove', ['id' => $member->id]) }}" class="partytax__member-buttons-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection