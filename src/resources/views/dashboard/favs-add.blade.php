@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="partytax page favs">
        <div class="container">
            <form action="{{ route('dashboard.room.mebmers.add') }}" method="POST" class="add-members-form">
                @csrf
                <div class="input-row mb-2">
                    <input type="text" placeholder="Имя + фамилия/прозвище" class="input form-control" name="room-member-name">
                </div>
                <div class="input-row add-members-form__button d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary w-full" class="input" value="Сохранить">
                </div>   
            </form>
        </div>
    </div>
@endsection