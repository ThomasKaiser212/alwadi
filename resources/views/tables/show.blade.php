@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">طاولة {{ $table->type }}</h5>
            <p class="card-text">عدد الكراسي: {{ $table->chairs }}</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">حجز الآن</button>
        </div>
    </div>
</div>

<!-- Reserve Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">حجز طاولة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tables.reserve', $table) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">نوع الطاولة</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="عادية">عادية</option>
                            <option value="فاخرة">فاخرة</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="number_of_tables" class="form-label">عدد الطاولات</label>
                        <input type="number" class="form-control" id="number_of_tables" name="number_of_tables" required>
                    </div>
                    <div class="mb-3">
                        <label for="number_of_chairs" class="form-label">عدد الكراسي</label>
                        <input type="number" class="form-control" id="number_of_chairs" name="number_of_chairs" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservation_start" class="form-label">موعد بدء الحجز</label>
                        <input type="datetime-local" class="form-control" id="reservation_start" name="reservation_start" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservation_end" class="form-label">موعد انتهاء الحجز</label>
                        <input type="datetime-local" class="form-control" id="reservation_end" name="reservation_end" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">احجز الآن</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
