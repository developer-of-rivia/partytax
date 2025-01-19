@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <form action="">
                <div>
                    <span>
                        Название
                    </span>
                    <input type="text" class="form-control" value="{{ $currentExpense->name }}">
                </div>
                <br>
                <div>
                    <span>
                        Количество
                    </span>
                    <input type="text" class="form-control" value="{{ $currentExpense->count }}">
                </div>
                <br>
                <div>
                    <span>
                        Цена
                    </span>
                    <input type="text" class="form-control" value="{{ $currentExpense->price }}">
                </div>
                <br>
                <button class="btn btn-primary">Сохранить</button>
            </form>
            <hr>
            <div class="mt-5">
                <h2>
                    Кто скидывается?
                    <a href="{{ route('expenses.paiders', $currentExpense->id) }}" class="btn btn-primary">Выбрать</a>
                </h2>
                <ul>
                    @foreach ($contributorsList as $item)
                        <li>
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection