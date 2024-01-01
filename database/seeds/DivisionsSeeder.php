<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::table('divisions')->insert([
            ['description' => 'Production Control Center', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Payroll', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Technical Support', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Human Resources', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Sustainable Quality Center', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Info Tech and Security', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Is Dept. Head', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
