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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            RolesAndPermissionsSeeder::class,
            StatusCategoriesSeeder::class,
            StatusesSeeder::class,
            SitesSeeder::class,
            DivisionsSeeder::class,
            ApplicationTypesSeeder::class,
            RequestTypesSeeder::class,
            ApproverTypesSeeder::class,
            DeptsSeeder::class,
            AccountTypesSeeder::class,
        ]);
    }
}
