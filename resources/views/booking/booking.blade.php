@extends('layouts.app')

@section('content')
<div class="container mt-4" dir="rtl">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="room-tab" data-toggle="tab" href="#rooms" role="tab" aria-controls="rooms" aria-selected="true">حجوزات الغرف</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="meals-tab" data-toggle="tab" href="#meals" role="tab" aria-controls="meals" aria-selected="false">حجوزات الوجبات</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="cars-tab" data-toggle="tab" href="#cars" role="tab" aria-controls="cars" aria-selected="false">حجوزات السيارات</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tables-tab" data-toggle="tab" href="#tables" role="tab" aria-controls="tables" aria-selected="false">حجوزات الطاولات</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="rooms" role="tabpanel" aria-labelledby="room-tab">
            @if($roomBookings->isEmpty())
                <p class="mt-3">لا توجد حجوزات غرف.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الغرفة</th>
                            <th>تاريخ الحجز</th>
                            <th>ساعة الحجز</th>
                            <th>سعة الغرفة </th>
                            <th>مساحة الغرفة  </th>
                            <th>سعر الحجز   </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roomBookings as $booking)
                            <tr>
                                <td>{{ $booking->bookable_id }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->created_at->format('H:i') }}</td>
                                <td>{{ $booking->bookable->capacity }}</td>
                                <td>{{ $booking->bookable->size }}</td>
                                <td>{{ $booking->bookable->price_per_night }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="tab-pane fade" id="meals" role="tabpanel" aria-labelledby="meals-tab">
            @if($mealBookings->isEmpty())
                <p class="mt-3">لا توجد حجوزات وجبات.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الوجبة</th>
                            <th>اسم الوجبة</th>
                            <th>سعر الوجبة</th>
                            <th>رقم الطلب</th>
                            <th>مقدم الطلب</th>
                            <th> البريد</th>
                            <th> حالة الدفع</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mealBookings as $booking)
                            <tr>
                                <td>{{ $booking->bookable_id }}</td>
                                <td>{{ $booking->bookable->meal_name }}</td>
                                <td>{{ $booking->bookable->price }}</td>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->user->email }}</td>
                                <td>مدفوعة</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars-tab">
            @if($carBookings->isEmpty())
                <p class="mt-3">لا توجد حجوزات سيارات.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الحجز</th>
                            <th>اسم مقدم الطلب</th>
                            <th> رقم الهاتف</th>
                            <th> الوجهة</th>
                            <th>تاريخ الطلب</th>
                            <th>موعد الحجز</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carBookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->full_name }}</td>
                                <td>{{ $booking->phone_number }}</td>
                                <td>{{ $booking->destination }}</td>
                                <td>{{ $booking->created_at }}</td>
                                <td>{{ $booking->reservation_time}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="tab-pane fade" id="tables" role="tabpanel" aria-labelledby="tables-tab">
            @if($tableBookings->isEmpty())
                <p class="mt-3">لا توجد حجوزات طاولات.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>نوع الطاولة </th>
                            <th>عدد الطاولات</th>
                            <th> عدد الكراسي </th>
                            <th>تاريخ الحجز</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tableBookings as $booking)
                            <tr>
                                <td> {{ $booking->id }} </td>
                                <td>{{ $booking->type }}</td>
                                <td>{{ $booking->number_of_tables }}</td>
                                <td>{{ $booking->number_of_chairs }}</td>
                                <td>{{ $booking->reservation_start }}</td>
                                <td>{{ $booking->reservation_end }}</td>
                                <td>{{ $booking->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
