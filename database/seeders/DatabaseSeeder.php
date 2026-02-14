<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AboutUsBanner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('Seeders are disabled in production! Use --force flag only if you know what you are doing.');
            return;
        }

        // Delete old images and files from storage
        $this->clearDirectories();

        $this->call(PermissionsSeeder::class);
        $this->call(SeoDatabaseSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(UserDatabaseSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(HomeBannerSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(PageBannerSeeder::class);
        $this->call(OurStepsSeeder::class);
        $this->call(StatisticsSeeder::class);
        $this->call(ChooseUsSeeder::class);
       // $this->call(BlockedPhoneSeeder::class);
       // $this->call(InspectionRequestSeeder::class);
    }


    public function clearDirectories()
    {
        // Path to the storage/app/public directory
        $storagePath = storage_path('app/public');

        // Delete all folders inside the storage path
        $folders = File::directories($storagePath);

        foreach ($folders as $folder) {
            File::deleteDirectory($folder);
        }

        echo ("  All folders in the storage path have been deleted.\n\n");
    }
}
