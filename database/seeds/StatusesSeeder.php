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
            ['status_code' => 'staff_active', 'description' => 'active', 'category_id' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'staff_inactive', 'description' => 'inactive', 'category_id' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'staff_retired', 'description' => 'retired', 'category_id' => 1, 'created_at' => $date, 'updated_at' => $date],

            // request status
            ['status_code' => 'request_pending', 'description' => 'pending', 'category_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_approved', 'description' => 'approved', 'category_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_rejected', 'description' => 'rejected', 'category_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_expired', 'description' => 'expired', 'category_id' => 2, 'created_at' => $date, 'updated_at' => $date],

            // site status
            ['status_code' => 'site_active', 'description' => 'active', 'category_id' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'site_inactive', 'description' => 'inactive', 'category_id' => 3, 'created_at' => $date, 'updated_at' => $date],

            // division status
            ['status_code' => 'division_active', 'description' => 'active', 'category_id' => 4, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'division_inactive', 'description' => 'inactive', 'category_id' => 4, 'created_at' => $date, 'updated_at' => $date],

            // application type status
            ['status_code' => 'application_type_active', 'description' => 'active', 'category_id' => 5, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'application_type_inactive', 'description' => 'inactive', 'category_id' => 5, 'created_at' => $date, 'updated_at' => $date],

            // request type status  
            ['status_code' => 'request_type_active', 'description' => 'active', 'category_id' => 6, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'request_type_inactive', 'description' => 'inactive', 'category_id' => 6, 'created_at' => $date, 'updated_at' => $date],

            // dept. status
            ['status_code' => 'dept_active', 'description' => 'active', 'category_id' => 7, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'dept_inactive', 'description' => 'inactive', 'category_id' => 7, 'created_at' => $date, 'updated_at' => $date],

            // account type status
            ['status_code' => 'account_type_active', 'description' => 'active', 'category_id' => 8, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_type_inactive', 'description' => 'inactive', 'category_id' => 8, 'created_at' => $date, 'updated_at' => $date],

            // account request status - dept. head
            ['status_code' => 'account_request_depthead_pending', 'description' => 'Pending Dept. Head Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_depthead_approved', 'description' => 'Approved by Dept. Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_depthead_rejected', 'description' => 'Rejected by Dept. Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // account request status - div. head
            ['status_code' => 'account_request_divhead_pending', 'description' => 'Pending Division Head Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_divhead_approved', 'description' => 'Approved by Division Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_divhead_rejected', 'description' => 'Rejected by Division Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // account request status - IS head
            ['status_code' => 'account_request_is_pending', 'description' => 'Pending MIS Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_is_approved', 'description' => 'Approved by MIS', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_is_rejected', 'description' => 'Rejected by MIS', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // account request status - President
            ['status_code' => 'account_request_president_pending', 'description' => 'Pending President Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_president_approved', 'description' => 'Approved by President', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'account_request_president_rejected', 'description' => 'Rejected by President', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // hris request status - Division
            ['status_code' => 'hris_request_division_pending', 'description' => 'Pending Division Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_division_approved', 'description' => 'Approved by Division', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_division_rejected', 'description' => 'Rejected by Division', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // hris request status - Dept. Head
            ['status_code' => 'hris_request_depthead_pending', 'description' => 'Pending Dept. Head Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_depthead_approved', 'description' => 'Approved by Dept. Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_depthead_rejected', 'description' => 'Rejected by Dept. Head', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // hris request status - Dpo 
            ['status_code' => 'hris_request_dpo_pending', 'description' => 'Pending Data Privacy Officer Approval', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_dpo_approved', 'description' => 'Approved by Data Privacy Officer', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'hris_request_dpo_rejected', 'description' => 'Rejected by Data Privacy Officer', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // final approved status
            ['status_code' => 'final_approved', 'description' => 'Approved', 'category_id' => 9, 'created_at' => $date, 'updated_at' => $date],

            // sap role status
            ['status_code' => 'sap_role_active', 'description' => 'active', 'category_id' => 10, 'created_at' => $date, 'updated_at' => $date],
            ['status_code' => 'sap_role_inactive', 'description' => 'inactive', 'category_id' => 10, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }
    }
}
