@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <div>
                <span>
                    Название
                </span>
                <strong>
                    {{ $currentExpense->name }}
                </strong>
            </div>
            <div>
                <span>
                    Количество
                </span>
                <strong>
                    {{ $currentExpense->count }} шт
                </strong>
            </div>
            <div>
                <span>
                    Цена
                </span>
                <strong>
                    {{ $currentExpense->price }} р
                </strong>
            </div>
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