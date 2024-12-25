@extends('base-layout')

@section('page_title', 'Главная страница welcome')



@section('specific_content')
    
    <div class="register">
        <div class="container">
            
            <div class="register__box">
                <h2>Быстрая регистрация</h2>
                <p>Чтобы сохранять ваши подсчёты</p>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input name="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="Логин">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Пароль</label>
                        <input name="password" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Пароль">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Имя</label>
                        <input name="name" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Имя">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Прозвище или фамилия</label>
                        <input name="secondname" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Второе имя">
                    </div>
                    <input type="submit" class="btn btn-primary">
                    <h6 class="mt-4">Есть аккаунт?</h6>
                    <a href="/sign-in" class="btn btn-primary">Войти</a>
                </form>
            </div>
                

        </div>
    </div>

@endsection