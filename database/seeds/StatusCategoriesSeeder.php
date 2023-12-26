<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $categories = [
            ['category_code' => 'staff_status', 'description' => 'staff status', 'created_at' => $date, 'updated_at' => $date],
            ['category_code' => 'request_status', 'description' => 'request status', 'created_at' => $date, 'updated_at' => $date],
            ['category_code' => 'site_status', 'description' => 'site status', 'created_at' => $date, 'updated_at' => $date],
            ['category_code' => 'division_status', 'description' => 'division status', 'created_at' => $date, 'updated_at' => $date],
            ['category_code' => 'application__type_status', 'description' => 'application type status',],
            ['category_code' => 'request_type_status', 'description' => 'request type status', 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($categories as $category) {
            DB::table('status_categories')->insert($category);
        }
    }
}