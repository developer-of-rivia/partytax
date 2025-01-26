@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <form action="{{ route('dashboard.room.expenses.create') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Пачка чипсов Lays" name="expense-name" value="{{ $currentExpense->name }}">
                    <label for="floatingInput">Название траты</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="2" name="expense-count" value="{{ $currentExpense->count }}">
                    <label for="floatingInput">Количество товара (шт)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="expenseType" id="expenseAll" value="expenseAll">
                    <label class="form-check-label" for="expenseAll">
                        Указать стоимость за всё количество
                    </label>
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="expenseType" id="expenseOne" value="expenseOne">
                    <label class="form-check-label" for="expenseOne">
                        Указать стоимость за <span>1</span> товар
                    </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Стоимость" name="price" value="{{ $currentExpense->price }}">
                    <label for="floatingInput">Стоимость</label>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
@endsection