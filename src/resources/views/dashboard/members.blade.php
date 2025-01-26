@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="container">
        @if(session()->get('canIEditThisRoom'))
            <a href="{{ route('dashboard.room.members.add-page') }}" class="partytax__btn btn btn-primary btn-sm">
                Добавить участника
            </a>
        @endif
        <div class="expenses-box mt-3">
            @foreach($members as $member)
                <div class="expense-item d-flex align-items-center gap-3">
                    @if(@session('canIEditThisRoom'))
                        <a href="{{ route('dashboard.room.members.edit', ['id' => $member->id]) }}" class="expense-item__edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    @endif
                    <div class="expenses__item-name flex-grow-1">
                        {{ $member->name }}
                    </div>
                    @if(@session('canIEditThisRoom'))
                        <a href="{{ route('dashboard.room.expenses.remove', $member->id) }}" class="expense-item__remove">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection