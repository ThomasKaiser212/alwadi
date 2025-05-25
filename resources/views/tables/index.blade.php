@extends('layouts.app')

@section('content')
<div class="container" style="position: relative; padding: 20px;">
    <!-- Container for image and content -->
    <div style="
        position: relative;
        background-image: url('{{ asset('images/tables/1.jpg') }}');
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        min-height: 600px; /* Ensure enough height */
        opacity: 0.8; /* Background image transparency */
        display: flex;
        justify-content: center;
        align-items: center;
    ">

        <!-- Overlay Text -->

        <!-- Form for table reservation -->
        <form action="{{ route('reserve-table.store') }}" method="POST" dir="rtl" style="
            position: relative;
            z-index: 2; /* Ensure form is above the overlay text */
            background: rgba(255, 255, 255, 0.9); /* Slightly opaque white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 80%; /* Make form width responsive */
            max-width: 600px; /* Optional: limit the maximum width */
        ">
            @csrf
            <div class="form-group">
                <label for="type">نوع الطاولة</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="فاخرة">فاخرة</option>
                    <option value="عادية">عادية</option>
                    <option value="جيدة">جيدة</option>
                </select>
            </div>
            <div class="form-group">
                <label for="number_of_tables">عدد الطاولات</label>
                <input
                    type="number"
                    class="form-control"
                    id="number_of_tables"
                    name="number_of_tables"
                    min="1"
                    max="3"
                    required
                    aria-describedby="numberOfTablesHelp"
                >
                <small id="numberOfTablesHelp" class="form-text text-muted">
                    أدخل عدد الطاولات بين 1 و 3.
                </small>
            </div>

            <div class="form-group">
                <label for="number_of_chairs">عدد الكراسي</label>
                <input
                    type="number"
                    class="form-control"
                    id="number_of_chairs"
                    name="number_of_chairs"
                    min="1"
                    max="14"
                    required
                    aria-describedby="numberOfChairsHelp"
                >
                <small id="numberOfChairsHelp" class="form-text text-muted">
                    أدخل عدد الكراسي بين 1 و 14.
                </small>
            </div>
            <div class="form-group">
                <label for="reservation_start">موعد بدء الحجز</label>
                <input
                    type="datetime-local"
                    class="form-control"
                    id="reservation_start"
                    name="reservation_start"
                    required
                >
            </div>

            <div class="form-group">
                <label for="reservation_end">موعد انتهاء الحجز</label>
                <input type="datetime-local" class="form-control" id="reservation_end" name="reservation_end" required>
            </div>
            <div class="form-group">
                <label for="notes">ملاحظات خاصة</label>
                <textarea class="form-control" id="notes" name="notes"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                padding: 12px 25px;
                font-size: 1.1em;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.3s;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            " onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';">
                احجز الآن
            </button>
        </form>
    </div>
</div>

<style>
    /* Ensure RTL Direction */
    form[dir="rtl"] {
        direction: rtl;
        text-align: right;
    }

    .form-group label {
        display: block;
        text-align: right;
    }

    .form-control {
        text-align: right; /* Align input text to the right */
    }
</style>
@endsection
