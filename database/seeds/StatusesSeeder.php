<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $statuses = [
            // staff status
            ['status_code' => 'staff_active', 'description' => 'active', 'category_code_id' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'staff_inactive', 'description' => 'inactive', 'category_code_id' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'staff_retired', 'description' => 'retired', 'category_code_id' => 1, 'created_at' => $date, 'updated_at' => $date],

            // request status
            ['status_code' => 'request_pending', 'description' => 'pending', 'category_code_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_approved', 'description' => 'approved', 'category_code_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_rejected', 'description' => 'rejected', 'category_code_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_expired', 'description' => 'expired', 'category_code_id' => 2, 'created_at' => $date, 'updated_at' => $date],

            // site status
            ['status_code' => 'site_active', 'description' => 'active', 'category_code_id' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'site_inactive', 'description' => 'inactive', 'category_code_id' => 3, 'created_at' => $date, 'updated_at' => $date],

            // division status
            ['status_code' => 'division_active', 'description' => 'active', 'category_code_id' => 4, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'division_inactive', 'description' => 'inactive', 'category_code_id' => 4, 'created_at' => $date, 'updated_at' => $date],

            // application type status
            ['status_code' => 'application_type_active', 'description' => 'active', 'category_code_id' => 5, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'application_type_inactive', 'description' => 'inactive', 'category_code_id' => 5, 'created_at' => $date, 'updated_at' => $date],

            // request type status  
            ['status_code' => 'request_type_active', 'description' => 'active', 'category_code_id' => 6, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_type_inactive', 'description' => 'inactive', 'category_code_id' => 6, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }
    }
}
