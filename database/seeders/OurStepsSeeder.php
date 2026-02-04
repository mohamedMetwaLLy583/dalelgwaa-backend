<?php

namespace Database\Seeders;

use App\Models\OurSteps;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class OurStepsSeeder extends Seeder
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
            $data = Arr::except($step, ['icons']);

            $ourSteps = OurSteps::create($data);

            foreach ($step['icons'] as $key => $iconPath) {
                $ourSteps
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
                'title_ar' => 'المعاينة الأولية للعقار',
                'title_en' => 'Initial Property Inspection',
                'description_ar' => 'قم بزيارة العقار لتفقده وتقييم حالته ومعرفة مميزاته ومراجعة التفاصيل التي تحتاج إلى توضيح',
                'description_en' => 'Visit the property to inspect it, assess its condition, understand its features, and review details that need clarification',
                'icons' => [
                    'icon' => '/steps_icons/1.svg',
                ],
            ],
            [
                'title_ar' => 'توقيع اتفاقية الوساطة والتسويق العقاري',
                'title_en' => 'Sign Real Estate Brokerage and Marketing Agreement',
                'description_ar' => 'توقيع عقد رسمي بينك وبين المالك لتنظيم عملية تسويق العقار وحقوق الطرفين',
                'description_en' => 'Sign a formal contract between you and the owner to organize the property marketing process and the rights of both parties',
                'icons' => [
                    'icon' => '/steps_icons/2.svg',
                ],
            ],
            [
                'title_ar' => 'التصوير الاحترافي للعقار',
                'title_en' => 'Professional Real Estate Photography',
                'description_ar' => 'الاستعانة بمصور محترف لالتقاط صور عالية الجودة، مع الاهتمام بالإضاءة والزوايا',
                'description_en' => 'Hire a professional photographer to take high-quality photos, paying attention to lighting and angles',
                'icons' => [
                    'icon' => '/steps_icons/3.svg',
                ],
            ],
            [
                'title_ar' => 'كتابة تفصيل العقار',
                'title_en' => 'Write Property Details',
                'description_ar' => 'وصف دقيق للممتلكات بما في ذلك الموقع، والمساحة، والمرافق، والحالة العامة',
                'description_en' => 'Accurate description of the property including location, area, facilities, and general condition',
                'icons' => [
                    'icon' => '/steps_icons/4.svg',
                ],
            ],
            [
                'title_ar' => 'تصميم بوستر للعقار وإضافته لموقعنا',
                'title_en' => 'Design Property Poster and Add to Our Website',
                'description_ar' => 'إعداد بوستر يحتوي على الصور والتفاصيل الرئيسية ونشره على الموقع الإلكتروني لمكتب العقار',
                'description_en' => 'Prepare a poster containing the main photos and details and publish it on the real estate office website',
                'icons' => [
                    'icon' => '/steps_icons/5.svg',
                ],
            ],
            [
                'title_ar' => 'جذب العملاء المحتملين',
                'title_en' => 'Attract Potential Clients',
                'description_ar' => 'استخدام وسائل الاتصال المختلفة لجذب المشترين المهتمين مثل الإعلانات',
                'description_en' => 'Use various communication methods to attract interested buyers such as advertisements',
                'icons' => [
                    'icon' => '/steps_icons/6.svg',
                ],
            ],
            [
                'title_ar' => 'التفاوض مع العميل وإتمام الصفقة',
                'title_en' => 'Negotiate with the Client and Close the Deal',
                'description_ar' => 'العمل على التفاوض على السعر وشروط البيع مع العميل حتى إتمام الصفقة وتوقيع العقود.',
                'description_en' => 'Work on negotiating the price and terms of sale with the client until the deal is closed and contracts are signed',
                'icons' => [
                    'icon' => '/steps_icons/7.svg',
                ],
            ],
            [
                'title_ar' => 'متابعة ما بعد البيع أو الإيجار',
                'title_en' => 'Post-Sale or Rental Follow-Up',
                'description_ar' => 'بعد إتمام الصفقة، يتم متابعة العميل للتأكد من رضاه عن العقار وتقديم الدعم اللازم',
                'description_en' => 'After the deal is completed, follow up with the client to ensure their satisfaction with the property and provide necessary support',
                'icons' => [
                    'icon' => '/steps_icons/8.svg',
                ],
            ],
        ];
    }
}
