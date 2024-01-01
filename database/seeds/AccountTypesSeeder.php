<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $accountTypes = [
            ['description' => 'GMail', 'status_id' => 18, 'current_charge' => 1000, 'created_at' => $date, 'updated_at' => $date, 'type' => 'global'],
            ['description' => 'Salesforce', 'status_id' => 18, 'current_charge' => 2100, 'created_at' => $date, 'updated_at' => $date, 'type' => 'global'],
            ['description' => 'SAP', 'status_id' => 18, 'current_charge' => 1900, 'created_at' => $date, 'updated_at' => $date, 'type' => 'global'],
            ['description' => 'Enovia', 'status_id' => 18, 'current_charge' => 1200, 'created_at' => $date, 'updated_at' => $date, 'type' => 'global'],
            ['description' => 'Wifi', 'status_id' => 18, 'current_charge' => 0, 'created_at' => $date, 'updated_at' => $date, 'type' => 'local'],
            ['description' => 'VPN', 'status_id' => 18, 'current_charge' => 0, 'created_at' => $date, 'updated_at' => $date, 'type' => 'local'],
        ];

        foreach ($accountTypes as $accountType) {
            DB::table('account_types')->insert($accountType);
        }
    }
}
