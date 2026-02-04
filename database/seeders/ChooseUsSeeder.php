<?php

namespace Database\Seeders;

use App\Models\ChooseUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed($this->steps());
    }

    public function seed(array $steps = []): void
    {
        foreach ($steps as $step) {
            $data = Arr::except($step, ['images']);

            $chooseUs = ChooseUs::create($data);

            foreach ($step['images'] as $key => $iconPath) {
                $chooseUs
                    ->addMedia(__DIR__ . $iconPath)
                    ->preservingOriginal()
                    ->toMediaCollection($key);
            }
        }
    }

    public function steps(): array
    {
        return [
            [
                'title_ar' => 'إرشادات الخبراء',
                'title_en' => 'Expert Guidance',
                'description_ar' => 'بفضل سنوات الخبرة في قطاع العقارات بالمملكة العربية السعودية، يقدم فريقنا رؤى ونصائح مصممة خصيصًا لتناسب تفضيلاتك.',
                'description_en' => 'With years of experience in the real estate sector in Saudi Arabia, our team offers insights and advice tailored to your preferences.',
                'images' => [
                    'image' => '/chooseUs_imgs/1.svg',
                ],
            ],
            [
                'title_ar' => 'مجموعة واسعة من العقارات',
                'title_en' => 'Wide Range of Properties',
                'description_ar' => 'من الشقق إلى الفيلات، والمكاتب إلى مساحات البيع بالتجزئة، نحن نلبي جميع احتياجات العقارات.',
                'description_en' => 'From apartments to villas, offices to retail spaces, we cater to all real estate needs.',
                'images' => [
                    'image' => '/chooseUs_imgs/2.svg',
                ],
            ],
            [
                'title_ar' => 'خدمة شخصية',
                'title_en' => 'Personalized Service',
                'description_ar' => 'نحن نركز على تقديم تجربة تركز على العملاء لجعل بحثك عن العقارات سلسًا وناجحً',
                'description_en' => 'We focus on providing a customer-centric experience to make your property search seamless and successful.',
                'images' => [
                    'image' => '/chooseUs_imgs/3.svg',
                ],
            ],
            [
                'title_ar' => 'إدارة الممتلكات',
                'title_en' => 'Property Management',
                'description_ar' => 'خدمات إدارة الممتلكات الشاملة للحفاظ على وتعزيز قيمة ممتلكاتك وإمكاناتها التأجيرية.',
                'description_en' => 'Comprehensive property management services to maintain and enhance the value and rental potential of your properties.',
                'images' => [
                    'image' => '/chooseUs_imgs/4.svg',
                ],
            ],
            [
                'title_ar' => 'الاستشارات الاستثمارية',
                'title_en' => 'Investment Consultation',
                'description_ar' => 'إرشادات من الخبراء لتحقيق أقصى عائد على استثماراتك العقارية، وضمان اتخاذ قرارات ذكية ومربحة.',
                'description_en' => 'Expert guidance to maximize returns on your real estate investments, ensuring smart and profitable decisions.',
                'images' => [
                    'image' => '/chooseUs_imgs/5.svg',
                ],
            ],
            [
                'title_ar' => 'تحليل السوق',
                'title_en' => 'Market Analysis',
                'description_ar' => 'تحليل متعمق للسوق يوفر رؤى قيمة حول اتجاهات العقارات والأسعار وفرص الاستثمار',
                'description_en' => 'In-depth market analysis provides valuable insights into real estate trends, prices, and investment opportunities',
                'images' => [
                    'image' => '/chooseUs_imgs/6.svg',
                ],
            ],
        ];
    }
}
