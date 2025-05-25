@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @php
            $imageCounter = 1;
            $images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg'];
        @endphp

        @foreach($meals as $meal)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm border-0 rounded-lg hover-zoom">
                    <img src="{{ asset('images/meals/'.$images[$imageCounter - 1]) }}" class="card-img-top img-fixed-size" alt="{{ $meal->meal_name }}">
                    <div class="card-body">
                        <h5 class="card-title text-center font-weight-bold">{{ $meal->meal_name }}</h5>
                        <p class="card-text text-center text-muted">السعر: ${{ $meal->price }}</p>
                        <p class="card-text text-center text-muted">الإضافات: {{ $meal->addons }}</p>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block mt-3" data-toggle="modal" data-target="#mealDetailModal{{ $meal->id }}">عرض التفاصيل</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meal Details Modal -->
            <div class="modal fade" id="mealDetailModal{{ $meal->id }}" tabindex="-1" role="dialog" aria-labelledby="mealDetailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mealDetailModalLabel">تفاصيل الوجبة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <p><strong>اسم الوجبة:</strong> {{ $meal->meal_name }}</p>
                            <p><strong>السعر:</strong> ${{ $meal->price }}</p>
                            <p><strong>الإضافات:</strong> {{ $meal->addons }}</p>
                            <p><strong>المكونات:</strong> {{ $meal->ingredients }}</p>
                            <div class="text-right mt-4">
                                <button class="btn btn-success" onclick="openOrderModal({{ $meal->id }})">احجز الآن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Modal -->
            <div class="modal fade" id="orderModal{{ $meal->id }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel">الدفع للوجبة {{ $meal->meal_name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <form id="orderForm{{ $meal->id }}" action="{{ route('order-meal.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="meal_id" value="{{ $meal->id }}">

                                <div class="form-group">
                                    <label for="card_number">رقم البطاقة</label>
                                    <input type="text" class="form-control text-right" id="card_number{{ $meal->id }}" name="card_number" required>
                                </div>

                                <div class="form-group">
                                    <label for="expiry_date">تاريخ الانتهاء (شهر/سنة)</label>
                                    <input type="text" class="form-control text-right" id="expiry_date{{ $meal->id }}" name="expiry_date" required>
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control text-right" id="cvv{{ $meal->id }}" name="cvv" required>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-block mt-3" onclick="submitOrderForm({{ $meal->id }})">تأكيد الطلب</button>
                                </div>
                            </form>

                            <div id="orderErrors{{ $meal->id }}" class="text-danger mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $imageCounter++;
                if($imageCounter > count($images)) {
                    $imageCounter = 1; // Reset the counter if it exceeds the number of images
                }
            @endphp
        @endforeach
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">تم الطلب بنجاح!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>تمت معالجة الطلب بنجاح.</p>
                <p>شكراً لحجز الوجبة <span id="successMealName"></span>.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('order-meal.index') }}';">متابعة</button>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-zoom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-zoom:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .img-fixed-size {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .modal-header {
        display: flex;
        justify-content: space-between; /* Space between title and close button */
        align-items: center;
        direction: ltr; /* Ensure correct alignment */
    }

    .modal-header .modal-title {
        margin: 0;
        text-align: left; /* Align text to the left */
    }

    .modal-header .close {
        margin-left: auto; /* Push close button to the right end */
    }
</style>

<script>
    function openOrderModal(mealId) {
        $('#mealDetailModal' + mealId).modal('hide'); // Close meal detail modal
        $('#orderModal' + mealId).modal('show'); // Show order modal
    }

    function submitOrderForm(mealId) {
        const form = document.getElementById('orderForm' + mealId);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                meal_id: formData.get('meal_id'),
                card_number: formData.get('card_number'),
                expiry_date: formData.get('expiry_date'),
                cvv: formData.get('cvv')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#orderModal' + mealId).modal('hide'); // Hide order modal
                $('#successMealName').text(data.meal_name);
                $('#successModal').modal('show'); // Show success modal
            } else {
                const errorsDiv = document.getElementById('orderErrors' + mealId);
                errorsDiv.innerHTML = '<p>حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.</p>';
            }
        })
        .catch(error => {
            const errorsDiv = document.getElementById('orderErrors' + mealId);
            errorsDiv.innerHTML = '<p>حدث خطأ أثناء معالجة الطلب. الرجاء المحاولة مرة أخرى.</p>';
            console.error('Error:', error);
        });
    }
</script>

@endsection
