@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <form action="{{ route('dashboard.room.members.update', $id) }}" method="POST" class="add-members-form">
                @csrf
                @method('put')
                <div class="input-row mb-2">
                    <input type="text" placeholder="Имя + фамилия/прозвище" class="input form-control" name="Name" value="{{ $memberName }}">
                </div>
                <div class="input-row add-members-form__button d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary w-full" class="input" value="Сохранить">
                </div>   
            </form>
        </div>
    </div>
@endsection