@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <a href="#" class="btn btn-success mb-2">
                Подсчитать кто, сколько должен
            </a>
            <a href="{{ route('partytax.room.expenses.create') }}" class="btn btn-primary">
                Добавить трату
            </a>
            <hr>
            @foreach($RoomExpenses as $expense)
                <div class="expense-item">
                    <span class="expense-item__name">
                        {{ $expense->name }}
                    </span>
                    <span class="expense-item__price">
                        {{ $expense->price }}р
                    </span>
                    <a href="{{ route('partytax.room.expenses.show', ['id' => $expense->id]) }}" class="expense-item__edit ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection