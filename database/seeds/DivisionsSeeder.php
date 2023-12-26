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
            ['description' => 'ISD', 'status_id' => 10, 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
