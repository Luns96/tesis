<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(RolesAndPermissions::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        // $this->call(GoalsTableSeeder::class);
        // $this->call(ObjectsTableSeeder::class);
    }
}
