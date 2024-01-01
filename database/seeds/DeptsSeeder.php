<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $depts = [
            ['description' => 'IT', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'HR', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Accounting', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Engineering', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'QA', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Production Control', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Data Privacy Dept.', 'status_id' => 16, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($depts as $dept) {
            DB::table('depts')->insert($dept);
        }
    }
}
