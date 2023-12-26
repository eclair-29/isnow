<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $applicationTypes = [
            ['application_type_code' => 'hris_application', 'description' => 'HRIS Application', 'status_id' => 12, 'created_at' => $date, 'updated_at' => $date],
            ['application_type_code' => 'account_application', 'description' => 'Account Application', 'status_id' => 12, 'created_at' => $date, 'updated_at' => $date],
            ['application_type_code' => 'jo_application', 'description' => 'Job Order Application', 'status_id' => 12, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($applicationTypes as $applicationType) {
            DB::table('application_types')->insert($applicationType);
        }
    }
}
