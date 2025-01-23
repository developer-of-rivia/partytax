@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="container expenses-show">
        <div class="mb-3">
            <label class="form-label">Название траты</label>
            <input type="text" class="form-control form-control-sm" value="{{ $currentExpense->name }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Количество товара</label>
            <input type="text" class="form-control form-control-sm" value="{{ $currentExpense->count }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Цена товара</label>
            <input type="text" class="form-control form-control-sm" value="{{ $currentExpense->price }}">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-full btn-sm">Сохранить</button>
        </div>
        <hr>
        <div class="mt-5">
            <h4 class="d-flex justify-content-between">
                <span>
                    Кто скидывается?
                </span>
                <a href="{{ route('expenses.paiders', $currentExpense->id) }}" class="btn btn-link btn-sm">Выбрать</a>
            </h4>
            @if($contributorsList->count() == 0)
                <div class="alert alert-secondary" role="alert">
                    Пока никто. Зря купили?
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($contributorsList as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                {{ $item->name }}
                            </span>

                            <span class="badge text-bg-primary rounded-pill ml-auto">
                                ✓
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection