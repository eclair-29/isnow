<?php

use App\Models\Approver;
use App\Models\Request;
use App\Models\RequestTracking;

function createRequestTracking($ticketId, $status, $notes)
{
    $ticketDetails = Request::select('id', 'user_id', 'status_id', 'approver_id')
        ->where('ticket_id', $ticketId)
        ->first();

    RequestTracking::create([
        'request_id' => $ticketDetails->id,
        'user_id' => $ticketDetails->user_id,
        'approver_id' => $ticketDetails->approver_id,
        'status_id' => $status,
        'notes' => $notes
    ]);
}

function getDivisionHead()
{
    $divisionHead = Approver::with('user')
        ->whereHas('user', function ($query) {
            $query->where('division_id', auth()->user()->division_id);
        })
        ->where('approver_type_id', 2)
        ->first();

    return $divisionHead;
}

function getDeptHead()
{
    $deptHead = Approver::with('user')
        ->whereHas('user', function ($query) {
            $query->where('dept_id', auth()->user()->dept_id);
        })
        ->where('approver_type_id', 1)
        ->first();

    return $deptHead;
}

function getIsHead()
{
    $isHead = Approver::with('user')
        ->whereHas('user', function ($query) {
            $query->where('dept_id', 1);
        })
        ->where('approver_type_id', 1)
        ->first();

    return $isHead;
}
