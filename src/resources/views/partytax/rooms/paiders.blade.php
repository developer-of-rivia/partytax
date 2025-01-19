@extends('partytax.partytax-layout')



@section('specific_content')
    <div class="paiders">
        <div class="container">
            <ul class="list-group">
                <form action="{{ route('expenses.paiders.update', $expenseNumber) }}" method="POST">
                    @csrf
                    @foreach($roomMembers as $roomMember)
                        @php($needChecked = false)
                        <label class="list-group-item d-flex justify-content-between">
                            <span>
                                {{ $roomMember->name }}
                            </span>
                            <div class="form-check">
                                @foreach($currentExpensePaiders as $paider)
                                    @if($paider->member_id == $roomMember->id && $paider->expense_id == $expenseNumber)
                                        @php($needChecked = true)
                                    @endif
                                @endforeach
                            </div>
                            <input class="form-check-input" type="checkbox" id="{{ $roomMember->id }}" name="{{ $roomMember->id }}" @if($needChecked == true) checked @endif>
                        </label>
                    @endforeach
                    <input type="text" hidden name="expenseNumber" value="{{ $expenseNumber }}">
                    <input type="submit" value="Отметить" class="btn btn-primary mt-3">
                </form>
            </ul>

        </div>
    </div>
@endsection