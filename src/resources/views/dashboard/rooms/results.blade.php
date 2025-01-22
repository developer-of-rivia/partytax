@extends('dashboard.layouts.dashboard-layout')



@section('specific_content')
    <div class="partytax page">
        <div class="container">
            <ul class="list-group">
                @foreach($allMembersResults as $name => $tax)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>
                            {{ $name }}
                        </span>
                        <strong>
                            {{ $tax }}р
                        </strong>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection