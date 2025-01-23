@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="container">
        @if(session()->get('canIEditThisRoom'))
            <a href="{{ route('dashboard.room.mebmers.add-page') }}" class="partytax__btn btn btn-primary btn-sm">
                Добавить участника
            </a>
        @endif
        <table class="table table-striped mt-4">
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>
                        {{ $member->name }}
                    </td>
                    <td>
                        @if(session()->get('canIEditThisRoom'))
                            <a href="{{ route('dashboard.room.mebmers.remove', ['id' => $member->id]) }}" class="partytax__member-buttons-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection