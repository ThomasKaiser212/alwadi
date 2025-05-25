@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment for Room {{ $room->id }}</h2>
    <form action="{{ route('confirm-payment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date (MM/YY)</label>
            <input type="text" class="form-control" id="expiry_date" name="expiry_date" required>
        </div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required>
        </div>
        <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </form>
</div>
@endsection
