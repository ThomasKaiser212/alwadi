@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @php
            $imageCounter = 1; // Initialize the counter
            $images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg']; // Array of image file names
        @endphp
        @foreach($rooms as $room)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm border-0 rounded-lg hover-zoom">
                    <img src="{{ asset('images/rooms/'.$images[$imageCounter - 1]) }}" class="card-img-top img-fixed-size" alt="{{ $room->name }}">

                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="star-rating">
                                @for ($i = 0; $i < 5; $i++)
                                    <span class="star {{ $i < $room->rating ? 'filled' : '' }}">&#9733;</span>
                                @endfor
                            </div>
                            <h5 class="card-title font-weight-bold mb-0 ml-auto">غرفة لـ{{ $room->capacity }} أشخاص</h5>
                        </div>
                        <p class="card-text text-center text-muted">السعر لليلة الواحدة: ${{ $room->price_per_night }}</p>
                        <p class="card-text text-center text-muted">المساحة: {{ $room->size }} متر مربع</p>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block mt-3" data-toggle="modal" data-target="#roomDetailModal{{ $room->id }}">عرض التفاصيل</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Details Modal -->
            <div class="modal fade" id="roomDetailModal{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="roomDetailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="roomDetailModalLabel">تفاصيل الغرفة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <p><strong>رقم الغرفة:</strong> {{ $room->id }}</p>
                            <p><strong>الوصف:</strong> {{ $room->description }}</p>
                            <p><strong>السعة:</strong> {{ $room->capacity }} أشخاص</p>
                            <p><strong>السعر لليلة الواحدة:</strong> ${{ $room->price_per_night }}</p>
                            <p><strong>المساحة:</strong> {{ $room->size }} متر مربع</p>
                            <div class="text-right mt-4">
                                <button class="btn btn-success" onclick="openPaymentModal({{ $room->id }})">احجز الآن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">الدفع للغرفة {{ $room->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <form id="paymentForm{{ $room->id }}" action="{{ route('book-room.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">

                                <div class="form-group">
                                    <label for="card_number">رقم البطاقة</label>
                                    <input type="text" class="form-control" id="card_number{{ $room->id }}" name="card_number" required>
                                </div>

                                <div class="form-group">
                                    <label for="expiry_date">تاريخ الانتهاء (شهر/سنة)</label>
                                    <input type="text" class="form-control" id="expiry_date{{ $room->id }}" name="expiry_date" required>
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv{{ $room->id }}" name="cvv" required>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-block mt-3" onclick="submitPaymentForm({{ $room->id }})">تأكيد الدفع</button>
                                </div>
                            </form>

                            <div id="paymentErrors{{ $room->id }}" class="text-danger mt-3"></div>
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
                <h5 class="modal-title" id="successModalLabel">تم الدفع بنجاح!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>تمت معالجة الدفع بنجاح.</p>
                <p>شكراً لحجز الغرفة رقم <span id="successRoomId"></span>.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('rooms.index') }}';">متابعة</button>
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
        width: 100%; /* Ensure the image takes up the full width of its container */
        height: 200px; /* Set a fixed height for the image */
        object-fit: cover; /* Crop the image to fit the container */
    }

    .star-rating {
        font-size: 1.25rem; /* Adjust as needed */
        color: #ffd700; /* Gold color for the stars */
        margin-right: 10px; /* Add space between stars and the title */
    }

    .star {
        display: inline-block;
        margin-right: 2px;
    }

    .star.filled {
        color: #ffd700; /* Gold color for filled stars */
    }

    .card-title {
        flex: 1; /* Allow the title to take the remaining space */
        text-align: right; /* Align text to the right */
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
    function openPaymentModal(roomId) {
        $('#roomDetailModal' + roomId).modal('hide'); // Close room detail modal
        $('#paymentModal' + roomId).modal('show'); // Show payment modal
    }

    function submitPaymentForm(roomId) {
        const form = document.getElementById('paymentForm' + roomId);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                room_id: formData.get('room_id'),
                card_number: formData.get('card_number'),
                expiry_date: formData.get('expiry_date'),
                cvv: formData.get('cvv'),
            })
        })
        .then(response => response.json().then(data => {
            if (!response.ok) {
                throw data;
            }
            return data;
        }))
        .then(data => {
            if (data.success) {
                $('#paymentModal' + roomId).modal('hide'); // Close payment modal on success

                // Update the success modal with the correct room ID
                document.getElementById('successRoomId').textContent = roomId;

                $('#successModal').modal('show'); // Show success modal
                form.reset(); // Reset form fields
            } else {
                const errorsDiv = document.getElementById('paymentErrors' + roomId);
                errorsDiv.innerHTML = '';
                for (const key in data.errors) {
                    data.errors[key].forEach(message => {
                        errorsDiv.innerHTML += `<p>${message}</p>`;
                    });
                }
            }
        })
        .catch(error => {
            const errorsDiv = document.getElementById('paymentErrors' + roomId);
            errorsDiv.innerHTML = `<p>حدث خطأ أثناء معالجة الدفع. الرجاء المحاولة مرة أخرى.</p>`;
            console.error('Error:', error);
        });
    }
</script>
@endsection
