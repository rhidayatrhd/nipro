<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HardwareGroup;
use Illuminate\Database\Seeder;
use Database\Seeders\UserRolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DepartmentSeeder::class,
            HardwareGrpSeeder::class,
            MasterConfigSeeder::class,
            UserRolePermissionSeeder::class,
            NavigationSeeder::class,
        ]);
    }
}
