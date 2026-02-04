<?php

namespace Database\Seeders;

use App\Enums\Property\OfferType;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Property;
use App\Models\PropertyTranslation;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed($this->properties());
    }

    public function seed(array $properties = []): void
    {
        foreach ($properties as $propertyData) {
            $propertyDataMain = Arr::except($propertyData, ['translations','image','gallery']);
            $property = Property::create($propertyDataMain);

            if (isset($propertyData['image'])) {
                $property
                    ->addMedia(__DIR__ . $propertyData['image'])
                    ->preservingOriginal()
                    ->toMediaCollection('main_image');
            }

            if (isset($propertyData['gallery']) && is_array($propertyData['gallery'])) {
                foreach ($propertyData['gallery'] as $galleryImage) {
                    $property
                        ->addMedia(__DIR__ . $galleryImage)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                }
            }

            foreach ($propertyData['translations'] as $translation) {
                $translation['property_id'] = $property->id;
                PropertyTranslation::create($translation);
            }
        }
    }

    public function properties(): array
    {

        $floorMapping = [
            'Ground' => 'الطابق الأرضي',
            '1st' => 'الطابق الأول',
            '2nd' => 'الطابق الثاني',
            '3rd' => 'الطابق الثالث',
        ];

        $furnishingMapping = [
            'Furnished' => 'مفروشة',
            'Semi-Furnished' => 'شبه مفروشة',
            'Unfurnished' => 'غير مفروشة',
        ];

        $finishingMapping = [
            'Luxury' => 'فاخر',
            'Standard' => 'عادي',
            'Economy' => 'اقتصادي',
        ];

        $properties = [];

        for ($i = 1; $i <= 50; $i++) {
            $floorEn = Arr::random(array_keys($floorMapping));
            $furnishingEn = Arr::random(array_keys($furnishingMapping));
            $finishingEn = Arr::random(array_keys($finishingMapping));

            $properties[] = [
                'type_id' => Type::pluck('id')->random(),
                'offer_type' => Arr::random([OfferType::Rent, OfferType::Sale]),
                'price' => rand(100000, 3000000),
                'area' => rand(50, 500),
                'rooms' => rand(1, 6),
                'bathrooms' => rand(1, 4),
                'is_available' => (bool)rand(0, 1),
                'in_home' => (bool)rand(0, 1),
                'view_count' => 0 ,
                'image' => '/property_imgs/property.png',
                'gallery' => [
                    '/property_imgs/gallery/Photo1.png',
                    '/property_imgs/gallery/Photo2.png',
                    '/property_imgs/gallery/Photo3.png',
                    '/property_imgs/gallery/Photo4.png',
                ],
                'translations' => [
                    [
                        'locale' => 'en',
                        'title' => "Property $i Title ",
                        'description' => "Description for property $i in English.",
                        'detailed_description' => "Detailed description for property $i in English.",
                        'address' => "$i Example Street, City",
                        'floor' => $floorEn,
                        'furnishing' => $furnishingEn,
                        'finishing' => $finishingEn,
                    ],
                    [
                        'locale' => 'ar',
                        'title' => "عنوان العقار $i ",
                        'description' => "الوصف الخاص بالعقار $i باللغة العربية.",
                        'detailed_description' => "الوصف التفصيلي للعقار $i باللغة العربية.",
                        'address' => "$i شارع المثال، المدينة",
                        'floor' => $floorMapping[$floorEn],
                        'furnishing' => $furnishingMapping[$furnishingEn],
                        'finishing' => $finishingMapping[$finishingEn],
                    ],
                ],
            ];
        }

        return $properties;
    }
}
