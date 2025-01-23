@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="partytax page favs">
        <div class="container">
            <div class="favs__info mb-2">
                Добавьте людей в избранные, чтобы не вписывать их имена каждый раз
            </div>
            <a href="{{ route('partytax-room-members-favs-add-page') }}" class="favs__add btn btn-secondary">
                Добавить имя
            </a>
            
        </div>
    </div>
@endsection