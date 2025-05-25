<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        $descriptions = [
            "غرفة مريحة تتميز بأثاث عصري وتصميم أنيق، توفر لك أجواءً هادئة ومريحة بعد يوم طويل.",
            "تتميز هذه الغرفة بإطلالة رائعة على المدينة، مع نوافذ كبيرة تسمح بدخول الضوء الطبيعي وتوفير جو منعش.",
            "غرفة ذات تصميم مفتوح، تضم سريرًا كبيرًا ومريحًا ومرافق حديثة تجعلها مثالية للإقامة الطويلة.",
            "تتمتع الغرفة بديكور دافئ وألوان هادئة، مع تفاصيل خشبية رائعة تضيف لمسة من الفخامة والراحة.",
            "غرفة أنيقة ومزودة بأحدث التقنيات، بما في ذلك تلفاز ذكي وتوصيل إنترنت عالي السرعة، لتلبية جميع احتياجاتك.",
            "غرفة تحتوي على شرفة خاصة، حيث يمكنك الاستمتاع بوجبة الإفطار أو الاسترخاء في الهواء الطلق مع مناظر خلابة.",
            "تتمتع الغرفة بوجود مساحة واسعة للتخزين، بما في ذلك خزانة ملابس كبيرة وأدراج لتسهيل تنظيم الأغراض.",
            "غرفة مجهزة بأثاث مريح وإضاءة دافئة، تخلق بيئة مثالية للقراءة والاسترخاء بعد يوم شاق.",
            "تضم الغرفة حمامًا خاصًا مزودًا بجميع وسائل الراحة الحديثة، مما يضمن تجربة إقامة مريحة وفاخرة.",
            "تتميز هذه الغرفة بوجود زاوية عمل مريحة مع مكتب كبير وكراسي مريحة، مما يجعلها مثالية للأعمال أو الدراسة."
        ];

        return [
            'capacity' => $this->faker->numberBetween(1, 10), // Random capacity between 1 and 10
            'price_per_night' => $this->faker->randomFloat(2, 50, 500), // Random price between 50 and 500
            'size' => $this->faker->numberBetween(80, 120), // Random size between 10 and 100 square meters
            'description' => $this->faker->randomElement($descriptions), // Randomly select one of the descriptions
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
