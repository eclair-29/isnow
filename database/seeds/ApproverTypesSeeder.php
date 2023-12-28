<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApproverTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $types = [
            ['type' => 'divhead', 'description' => 'Division Head', 'created_at' => $date, 'updated_at' => $date],
            ['type' => 'depthead', 'description' => 'department Head', 'created_at' => $date, 'updated_at' => $date],
            ['type' => 'supervisor', 'description' => 'Supervisor', 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($types as $type) {
            DB::table('approver_types')->insert($type);
        }
    }
}
