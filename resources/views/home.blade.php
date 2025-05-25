@extends('layouts.app')

@section('content')
    <style>
        .card {
            border: 1px solid #6c757d;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card .card-body {
            padding: 1rem;
        }
    </style>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-gray h-100 shadow-sm rounded">
                    <img src="{{ asset('images/room.jpg') }}" class="card-img-top" alt="Room Image">
                    <div class="card-body">
                        <h5 class="card-title">احجز غرفة</h5>
                        <p>احجز غرفة لإقامتك</p>
                        <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-block">احجز الآن</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-gray h-100 shadow-sm rounded">
                    <img src="{{ asset('images/table.jpg') }}" class="card-img-top" alt="Table Image">
                    <div class="card-body">
                        <h5 class="card-title">احجز طاولة</h5>
                        <p>احجز طاولة في مطعمنا</p>
                        <a href="{{ route('reserve-table.index') }}" class="btn btn-primary btn-block">احجز الآن</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-gray h-100 shadow-sm rounded">
                    <img src="{{ asset('images/meal.jpg') }}" class="card-img-top" alt="Meal Image">
                    <div class="card-body">
                        <h5 class="card-title">احجز وجبة</h5>
                        <p>اطلب وجبة من مطعمنا</p>
                        <a href="{{ route('order-meal.index') }}" class="btn btn-primary btn-block">احجز الآن</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-gray h-100 shadow-sm rounded">
                    <img src="{{ asset('images/taxi.jpg') }}" class="card-img-top" alt="Taxi Image">
                    <div class="card-body">
                        <h5 class="card-title">احجز سيارة أجرة</h5>
                        <p>احجز سيارة أجرة للتنقل</p>
                        <a href="{{ route('reserve-car.index') }}" class="btn btn-primary btn-block">احجز الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
