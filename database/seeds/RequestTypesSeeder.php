<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RequestTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $requestTypes = [
            ['request_type_code' => 'new', 'description' => 'New', 'application_type_id' => 1, 'status_id' => 14, 'created_at' => $date, 'updated_at' => $date],
            ['request_type_code' => 'add', 'description' => 'Add', 'application_type_id' => 1, 'status_id' => 14, 'created_at' => $date, 'updated_at' => $date],
            ['request_type_code' => 'unblock', 'description' => 'Unblock', 'application_type_id' => 1, 'status_id' => 14, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($requestTypes as $requestType) {
            DB::table('request_types')->insert($requestType);
        }
    }
}
