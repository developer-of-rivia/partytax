@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="home page">
        <div class="container">
            <form action="{{ route('partytax-rooms-subscribers-add') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3"> 
                    <label for="formGroupExampleInput" class="form-label">Ссылка для обзора комнаты:</label>
                    <input name="roomLink" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ссылка для обзора комнаты">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Пароль от комнаты</label>
                    <input name="roomPass" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите пароль">
                </div>
                <!---->
                <input type="submit" value="Подписаться на комнату" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection