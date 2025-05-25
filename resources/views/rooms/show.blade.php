@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <img src="{{ $room->image }}" class="card-img-top" alt="{{ $room->room_type }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->room_type }}</h5>
                    <p class="card-text">السعة: {{ $room->capacity }} أشخاص</p>
                    <p class="card-text">سعر الليلة: {{ $room->price_per_night }}$</p>
                    <p class="card-text">مساحة الغرفة: {{ $room->room_size }} متر مربع</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">حجز الغرفة</div>
                <div class="card-body">
                    <form id="reservationForm" method="POST" action="{{ route('rooms.reserve', $room->id) }}">
                        @csrf
                       {{$room->id}}
                        <div class="mb-3">
                            <label for="reservation_start" class="form-label">موعد بدء الحجز</label>
                            <input type="datetime-local" class="form-control" id="reservation_start" name="reservation_start" required>
                        </div>
                        <div class="mb-3">
                            <label for="reservation_end" class="form-label">موعد انتهاء الحجز</label>
                            <input type="datetime-local" class="form-control" id="reservation_end" name="reservation_end" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="openPaymentPopup()">احجز الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">تفاصيل الدفع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="paymentForm" action="{{ route('rooms.payment', $room->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="card_number" class="form-label">رقم البطاقة</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="ادخل رقم البطاقة">
                    </div>
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">تاريخ الانتهاء</label>
                        <input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="MM/YY">
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary" id="confirmPaymentBtn">تاكيد الدفع</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Message Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">تم حجز الغرفة بنجاح</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                تم حجز الغرفة بنجاح.
            </div>
        </div>
    </div>
</div>

<script>
    function openPaymentPopup() {
        $('#paymentModal').modal('show');
    }

    $('#paymentForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#paymentModal').modal('hide');
                $('#successModal').modal('show');
                setTimeout(function() {
                    window.location.href = "{{ route('rooms.index') }}";
                }, 2000); // Adjust the delay as needed
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
</script>
@endsection
