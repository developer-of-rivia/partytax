@extends('base-layout')

@section('page_title', 'Главная страница welcome')



@section('specific_content')
    
    <div class="register">
        <div class="container">
            
            <div class="register__box">
                <h2>Вход</h2>
                <form action="sign-in" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input name="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="Логин">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Пароль</label>
                        <input name="password" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Пароль">
                    </div>
                    <input type="submit" value="Войти" class="btn btn-primary">
                    <h6 class="mt-4">Нет аккаунта?</h6>
                    <a href="/register" class="btn btn-primary">Регистрация</a>
                </form>
            </div>
                

        </div>
    </div>

@endsection