<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SapRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::table('sap_roles')->insert([
            ['description' => 'NCFL  Material Warehouse (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Purchase (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting All Master/Report Display', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Production Asset Management', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Manufacturing (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Raw Materials (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'EDI Delivery date confirm for NCFL', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Purchase (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Material Inventory Management', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  PO Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  PO Approval', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  PO Approval', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL PIR Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  FG Warehouse (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Global Display(NCFL)　', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL DO (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Sales Demand & Supply', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Quality Inspection (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Material Inventory Management', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Quality Inspection (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  FG Warehouse (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Material Warehouse (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  System Dept (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL PIR Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Price Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  System Dept Data Change(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  System Dept Master Change(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  System Dept (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  System Dept Data Change(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  System Dept Master Change(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Global Display(NCFS)　', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'FI common display(NCFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'FI common display(NPFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'PP common display(NCFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'PP common display(NCJ)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'PP common display(NPFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NPFL)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Import and Export (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Import and Export (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCJ)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCSS Sales/Shipment Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCSS Sales Reference', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCSS PO Creation (241-244,FDBM,GAMS,ACIM,AMEC)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCAM)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCHK)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCHS)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCHZ)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCTT)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NET)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting All Master/Report Display', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. AP clearing', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting Doc Posting(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  PO Creation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Manufacturing (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. AP clearing', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. AR clearing', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. Asset Posting', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. Auto Payment and Foreign Currency Valuation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. Cash Journal', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting Park Doc Entry(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Production Master Data Maintenance', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Production Schedule(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Production Master Data Maintenance', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Manufacturing (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  Production Schedule(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL SO (Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting Doc Posting(Staff)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  CREDIT MANAGEMENT', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL Accounting D.I. Cost Calculation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCFL  Application Display', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  Application Display', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCJ SAS Display(Common)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCJ SAS Display(Detail)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCJ SAS Orders', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NCJ ATP Create', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'SD common display(NCSS)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  Purchase (Manager)', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL  CREDIT MANAGEMENT', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. AR clearing', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. Asset Posting', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. Cost Calculation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. Auto Payment and Foreign Currency Valuation', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'NPFL Accounting D.I. Cash Journal', 'status_id' => 42, 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
