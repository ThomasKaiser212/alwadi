@extends('layouts.app')

@section('content')
<!-- Hide the default navigation bar on this page -->
<style>
    .navbar {
        display: none;
    }

    /* Style for the logout button */
    .logout-btn {
        color: #dc3545; /* Red color for logout link */
        font-weight: bold;
        cursor: pointer;
        text-align: right;
        display: inline-block;
    }

    .logout-btn:hover {
        text-decoration: underline;
    }

    /* RTL for the popup modal */
    .modal-content {
        direction: rtl;
    }

    /* Align close button on the left and title on the right */
    .modal-header {
        justify-content: space-between;
    }

    .modal-title {
        order: 2;
    }

    .close {
        order: 1;
    }
</style>

<div class="container mt-4" dir="rtl">
    <!-- Show admin name with logout option -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="font-weight-bold">{{ Auth::user()->name }}</span>
        </div>
        <div>
            <span class="logout-btn" data-toggle="modal" data-target="#logoutModal">
                تسجيل الخروج
            </span>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="logoutModalLabel">تأكيد تسجيل الخروج</h5>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد تسجيل الخروج؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">نعم، تسجيل الخروج</button>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

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
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">المستخدمون</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="myTabContent">
        <!-- Rooms Tab -->
        <div class="tab-pane fade show active" id="rooms" role="tabpanel" aria-labelledby="room-tab">
            @if($reservedRooms->isEmpty())
                <p class="mt-3">لا توجد حجوزات غرف.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الغرفة</th>
                            <th>تاريخ الحجز</th>
                            <th>ساعة الحجز</th>
                            <th>سعة الغرفة</th>
                            <th>مساحة الغرفة</th>
                            <th>سعر الحجز</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservedRooms as $room)
                            @foreach($room->bookings as $booking)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $booking->check_in }}</td>
                                    <td>{{ $booking->created_at->format('H:i') }}</td>
                                    <td>{{ $room->capacity }}</td>
                                    <td>{{ $room->size }}</td>
                                    <td>{{ $room->price_per_night }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- Meals Tab -->
        <div class="tab-pane fade" id="meals" role="tabpanel" aria-labelledby="meals-tab">
            @if($orderedMeals->isEmpty())
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
                            <th>البريد</th>
                            <th>حالة الدفع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderedMeals as $meal)
                            @foreach($meal->bookings as $booking)
                                <tr>
                                    <td>{{ $meal->id }}</td>
                                    <td>{{ $meal->meal_name }}</td>
                                    <td>{{ $meal->price }}</td>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->user->email }}</td>
                                    <td>مدفوعة</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- Cars Tab -->
        <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars-tab">
            @if($reservedCars->isEmpty())
                <p class="mt-3">لا توجد حجوزات سيارات.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الحجز</th>
                            <th>اسم مقدم الطلب</th>
                            <th>رقم الهاتف</th>
                            <th>الوجهة</th>
                            <th>تاريخ الطلب</th>
                            <th>موعد الحجز</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservedCars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->user->name }}</td>
                                <td>{{ $car->phone_number }}</td>
                                <td>{{ $car->destination }}</td>
                                <td>{{ $car->created_at }}</td>
                                <td>{{ $car->reservation_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- Tables Tab -->
        <div class="tab-pane fade" id="tables" role="tabpanel" aria-labelledby="tables-tab">
            @if($reservedTables->isEmpty())
                <p class="mt-3">لا توجد حجوزات طاولات.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>نوع الطاولة</th>
                            <th>عدد الطاولات</th>
                            <th>عدد الكراسي</th>
                            <th>تاريخ الحجز</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservedTables as $table)
                            <tr>
                                <td>{{ $table->id }}</td>
                                <td>{{ $table->type }}</td>
                                <td>{{ $table->number_of_tables }}</td>
                                <td>{{ $table->number_of_chairs }}</td>
                                <td>{{ $table->reservation_start }}</td>
                                <td>{{ $table->reservation_end }}</td>

                                <td>{{ $table->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- Users Tab -->
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            @if($users->isEmpty())
                <p class="mt-3">لا يوجد مستخدمون.</p>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>اسم المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
