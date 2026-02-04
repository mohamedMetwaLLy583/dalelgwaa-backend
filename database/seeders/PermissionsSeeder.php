<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\PermissionTranslation;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed($this->permissions());
    }

    public function seed(array $permissions = []): void
    {
        $permissions_array = [];

        foreach ($permissions as $permission) {
            $model = Permission::firstOrCreate(['name' => $permission['name']]);

            $model->translations()->delete();

            foreach ($permission['translations'] as $translation) {
                PermissionTranslation::create([
                    'display_name' => $translation['display_name'],
                    'locale' => $translation['locale'],
                    'permission_id' => $model->id,
                ]);
            }

            $role = Role::create(['name' => $permission['name']]);

            $role->translateOrNew('ar')->display_name =  $permission['display_name_ar'];
            $role->translateOrNew('en')->display_name =  $permission['display_name_en'];

            $role->permissions()->attach([$model->id]);

            $role->save();

            $permissions_array[] = $model->id;
        }

        $role = Role::create(['name' => 'super_admin']);

        $role->translateOrNew('ar')->display_name =  'المشرف الأعلى';
        $role->translateOrNew('en')->display_name =  'Super admin';

        $role->permissions()->attach($permissions_array);

        $role->save();
    }

    private function permissions(): array
    {
        return [
            [
                'name' => 'about_us',
                'display_name_ar' => 'من نحن',
                'display_name_en' => 'About us',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'من نحن'],
                    ['locale' => 'en', 'display_name' => 'About us'],
                ],
            ],
            [
                'name' => 'admin',
                'display_name_ar' => 'الإدارة',
                'display_name_en' => 'admin',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الإدارة'],
                    ['locale' => 'en', 'display_name' => 'Admin'],
                ],
            ],
            [
                'name' => 'contact_us',
                'display_name_ar' => 'إتصل بنا',
                'display_name_en' => 'contact_us',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'إتصل بنا'],
                    ['locale' => 'en', 'display_name' => 'Contact us'],
                ],
            ],
            [
                'name' => 'setting',
                'display_name_ar' => 'الإعدادات',
                'display_name_en' => 'setting',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الإعدادات'],
                    ['locale' => 'en', 'display_name' => 'Setting'],
                ],
            ],
            [
                'name' => 'role',
                'display_name_ar' => 'القواعد',
                'display_name_en' => 'role',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'القواعد'],
                    ['locale' => 'en', 'display_name' => 'Role'],
                ],
            ],
            [
                'name' => 'seo',
                'display_name_ar' => 'البحث',
                'display_name_en' => 'SEO',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'البحث'],
                    ['locale' => 'en', 'display_name' => 'SEO'],
                ],
            ],
            [
                'name' => 'home_banner',
                'display_name_ar' => 'البانر الرئيسي',
                'display_name_en' => 'Home banner',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'البانر الرئيسي'],
                    ['locale' => 'en', 'display_name' => 'Home banner'],
                ],
            ],
            [
                'name' => 'pages_banner',
                'display_name_ar' => 'بانر الصفحات',
                'display_name_en' => 'Pages banner',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'بانر الصفحات'],
                    ['locale' => 'en', 'display_name' => 'Pages banner'],
                ],
            ],
            [
                'name' => 'home',
                'display_name_ar' => 'الرئيسية',
                'display_name_en' => 'Home',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الرئيسية'],
                    ['locale' => 'en', 'display_name' => 'Home'],
                ],
            ],
            [
                'name' => 'our-steps',
                'display_name_ar' => 'خطواتنا',
                'display_name_en' => 'Our steps',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'خطواتنا'],
                    ['locale' => 'en', 'display_name' => 'Our steps'],
                ],
            ],
            [
                'name' => 'statistics',
                'display_name_ar' => 'الإحصائيات',
                'display_name_en' => 'Statistics',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الإحصائيات'],
                    ['locale' => 'en', 'display_name' => 'Statistics'],
                ],
            ],
            [
                'name' => 'choose-us',
                'display_name_ar' => 'إخترنا',
                'display_name_en' => 'Choose us',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'إخترنا'],
                    ['locale' => 'en', 'display_name' => 'Choose us'],
                ],
            ],
            [
                'name' => 'review',
                'display_name_ar' => 'التقييمات',
                'display_name_en' => 'Review',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'التقييمات'],
                    ['locale' => 'en', 'display_name' => 'Review'],
                ],
            ],
            [
                'name' => 'reservation',
                'display_name_ar' => 'الحجوزات',
                'display_name_en' => 'Reservation',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الحجوزات'],
                    ['locale' => 'en', 'display_name' => 'Reservation'],
                ],
            ],
            [
                'name' => 'blocked-phones',
                'display_name_ar' => 'الهواتف المحظورة',
                'display_name_en' => 'Blocked phones',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الهواتف المحظورة'],
                    ['locale' => 'en', 'display_name' => 'Blocked phones'],
                ],
            ],
            [
                'name' => 'property',
                'display_name_ar' => 'العقارات',
                'display_name_en' => 'Property',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'العقارات'],
                    ['locale' => 'en', 'display_name' => 'Property'],
                ],
            ],
            [
                'name' => 'inspection-request',
                'display_name_ar' => 'طلبات الفحص',
                'display_name_en' => 'Inspection request',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'طلبات الفحص'],
                    ['locale' => 'en', 'display_name' => 'Inspection request'],
                ],
            ],
            [
                'name' => 'type',
                'display_name_ar' => 'الأنواع',
                'display_name_en' => 'Type',
                'translations' => [
                    ['locale' => 'ar', 'display_name' => 'الأنواع'],
                    ['locale' => 'en', 'display_name' => 'Type'],
                ],
            ]
        ];
    }
}
