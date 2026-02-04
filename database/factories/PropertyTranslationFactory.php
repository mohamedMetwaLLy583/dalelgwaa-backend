<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyTranslation>
 */
class PropertyTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locale = $this->faker->randomElement(['en', 'ar']);

        $arabicFaker = \Faker\Factory::create('ar_SA');

        return [
            'property_id' => null,
            'locale' => $locale,
            'title' => $locale === 'ar' ? 'عنوان العقار' : 'title for property',
            'description' => $locale === 'ar' ? 'وصف العقار' : 'description for property',
            'detailed_description' => $locale === 'ar' ? 'وصف مفصل للعقار' : 'detailed description for property',
            'address' => $locale === 'ar' ? 'موقع العقار' : 'address for property',
            'type' => $locale === 'ar' ? $arabicFaker->randomElement(['شقة', 'منزل', 'فيلا']) : $this->faker->randomElement(['apartment', 'house', 'villa']),
            'offer_type' => $locale === 'ar' ? $arabicFaker->randomElement(['للبيع', 'للايجار']) : $this->faker->randomElement(['sale', 'rent']),
            'floor' => $this->faker->numberBetween(1, 10),
            'furnishing' => $locale === 'ar' ? $arabicFaker->randomElement(['مفروش', 'نصف مفروش', 'غير مفروش']) : $this->faker->randomElement(['furnished', 'semi-furnished', 'unfurnished']),
            'finishing' => $locale === 'ar' ? $arabicFaker->randomElement(['فاخر', 'عادي', 'قياسي']) : $this->faker->randomElement(['luxury', 'basic', 'standard']),
        ];
    }
}
