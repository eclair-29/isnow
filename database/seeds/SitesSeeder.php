<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::table('sites')->insert([
            ['site_code' => 'NCFL', 'description' => 'Nidec Philippines Corporation', 'status_id' => 8, 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
