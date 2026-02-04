<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{

    private $admins = [
        'Developer' => 'dev',
        'Admin' => 'admin',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->admins as $name => $email) {
            $user = User::factory()->create([
                'name' => $name,
                'email' => "$email@$email.com",
            ]);

            $user->syncRoles(['super_admin']);

            if ($name === 'Admin') {
                $user->addMedia(__DIR__ . '/profile_imgs/profile.svg' )
                ->preservingOriginal()
                    ->toMediaCollection();
            }

            $user->save();
        }
    }
}
