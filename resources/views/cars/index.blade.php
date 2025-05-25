@extends('layouts.app')

@section('content')
<div class="container" style="position: relative; padding: 20px; direction: rtl; text-align: right;">
    <!-- Container for image and content -->
    <div style="
        position: relative;
        background-image: url('{{ asset('images/cars/1.jpg') }}');
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        min-height: 600px; /* Ensure enough height */
        opacity: 0.8; /* Background image transparency */
        display: flex;
        justify-content: center;
        align-items: center;
    ">

        <!-- Form for car reservation -->
        <form id="reservation-form" action="{{ route('reserve-car.store') }}" method="POST" dir="rtl" style="
            position: absolute; /* Position form over the image */
            z-index: 2; /* Ensure form is above the background image */
            background: rgba(255, 255, 255, 0.9); /* Slightly opaque white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 80%; /* Make form width responsive */
            max-width: 600px; /* Optional: limit the maximum width */
            margin: 0 auto; /* Center the form */
            top: 10%; /* Position the form down a bit from the top */
        ">
            @csrf
            <div class="form-group">
                <label for="full_name">الاسم الكامل</label>
                <input
                    type="text"
                    class="form-control"
                    id="full_name"
                    name="full_name"
                    required
                >
            </div>
            <div class="form-group">
                <label for="phone_number">رقم الهاتف</label>
                <input
                    type="text"
                    class="form-control"
                    id="phone_number"
                    name="phone_number"
                    pattern="09\d{8}"
                    title="رقم الهاتف يجب أن يكون مكوناً من 10 أرقام ويبدأ بـ 09"
                    required
                >
            </div>
            <div class="form-group">
                <label for="destination">الوجهة</label>
                <select class="form-control" id="destination" name="destination" required>
                    <option value="">اختر الوجهة</option>
                    <option value="الحميدية">الحميدية</option>
                    <option value="الزهراء">الزهراء</option>
                    <option value="الغوطة">الغوطة</option>
                    <option value="عكرمة">عكرمة</option>
                    <option value="البياضة">البياضة</option>
                    <option value="البرج">البرج</option>
                    <option value="المهندسين">المهندسين</option>
                    <option value="السلطانية">السلطانية</option>
                    <option value="الأرمن">الأرمن</option>
                    <option value="النزهة">النزهة</option>
                    <option value="العباسية">العباسية</option>
                    <option value="باب تدمر">باب تدمر</option>
                    <option value="الملعب">الملعب</option>
                    <option value="الميدان">الميدان</option>
                    <option value="الصليبة">الصليبة</option>
                    <option value="دير بعلبة">دير بعلبة</option>
                    <option value="الضاحية">الضاحية</option>
                    <option value="الكرامة">الكرامة</option>
                    <option value="جورة الشياح">جورة الشياح</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reservation_time">موعد الحجز</label>
                <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" required>
            </div>
            <div class="form-group">
                <label for="number_of_people">عدد الأشخاص</label>
                <input
                    type="number"
                    class="form-control"
                    id="number_of_people"
                    name="number_of_people"
                    min="1"
                    max="3"
                    title="الحد الأقصى لعدد الركاب هو 3 والحد الأدنى هو 1."
                    required
                >
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

    <!-- Description -->
    <div style="font-size: 1.2em; color: #555; text-align: center; margin-bottom: 20px;">
        <p>تقدم خدمات حجز السيارات لدينا تجربة مريحة وسريعة، مع مجموعة متنوعة من السيارات لتناسب احتياجاتك. احجز سيارتك الآن واستمتع برحلة مريحة.</p>
    </div>
</div>

<script>
    function scrollToForm() {
        // Get the form element
        const form = document.getElementById('reservation-form');
        // Scroll to the form smoothly
        form.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
