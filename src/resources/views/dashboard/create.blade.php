@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="home page">
        <div class="container">
            <form action="{{ route('dashboard.create-page') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3"> 
                    <label for="formGroupExampleInput" class="form-label">Название комнаты</label>
                    <input name="room-name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите название комнаты">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Пароль от комнаты</label>
                    <input name="room-pass" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите пароль">
                </div>
                <!---->
                <input type="submit" value="Создать" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection