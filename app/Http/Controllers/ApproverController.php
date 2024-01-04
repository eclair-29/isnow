<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Approver;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RequestTracking;
use App\Models\Request as ModelsRequest;
use App\Http\Requests\UpdateTicketRequest;

class ApproverController extends Controller
{
    public function updateApprovedRequest(ModelsRequest $requestDetails, $notes)
    {
        $status = $requestDetails->status->id;
        $ticket = $requestDetails->ticket_id;

        // approvers
        $deptHead = getDeptHead();
        $divisionHead = getDivisionHead();
        $isHead = getIsHead();

        // update request for next approval process
        if ($status == 20) {
            // approved by dept. head
            createRequestTracking($ticket, 21, $notes);

            $requestDetails->update(['status_id' => 23, 'approver_id' => $divisionHead->id]);

            // pending approval for division head
            createRequestTracking($ticket, 23, null);
        }

        if ($status == 23) {
            // approved by division head
            createRequestTracking($ticket, 24, $notes);

            $requestDetails->update(['status_id' => 26, 'approver_id' => $isHead->id]);

            // pending approval for IS head
            createRequestTracking($ticket, 26, null);
        }

        if ($status == 26) {
            // approved by IS head
            createRequestTracking($ticket, 27, $notes);

            $requestDetails->update(['status_id' => 41, 'approver_id' => null]);

            // final approved
            createRequestTracking($ticket, 41, null);
        }
    }

    public function updateRejectedRequest(ModelsRequest $requestDetails, $notes)
    {
        $status = $requestDetails->status->id;
        $ticket = $requestDetails->ticket_id;

        if ($status == 20) {
            $requestDetails->update(['status_id' => 22]);
            createRequestTracking($ticket, 22, $notes);
        }

        if ($status === 23) {
            $requestDetails->update(['status_id' => 25]);
            createRequestTracking($ticket, 25, $notes);
        }

        if ($status === 26) {
            $requestDetails->update(['status_id' => 28]);
            createRequestTracking($ticket, 28, $notes);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approver = Approver::where('user_id', auth()->user()->id)->first();
        $approvals = ModelsRequest::where('approver_id', $approver->id)
            ->whereNotIn('status_id', [22, 25, 28, 31, 34, 27, 40])
            ->get();
        return view('approver.index', ['approvals' => $approvals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = ModelsRequest::where('id', $id)
            ->with('approver', 'requestType', 'status', 'user', 'applicationType', 'accountApplication')
            ->first();
        $requestTracking = RequestTracking::where('request_id', $id)->get();
        $user = User::find(auth()->user()->id);
        $disableBtns =
            Str::contains($request->status->description, 'Rejected') || $request->approver == null ||
            $user->id != $request->approver->user->id ? 'disabled' : '';

        return view('approver.show', [
            'request' => $request,
            'requestTracking' => $requestTracking,
            'user' => $user,
            'disableBtns' => $disableBtns
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $validated = $request->validated();
        $action = $request->action;
        $requestDetails = ModelsRequest::findOrFail($id);

        // assign notes value
        if ($action == 'approved') {
            $validated['notes'] = $request->input('approved_notes');

            // update request for next approval process
            $this->updateApprovedRequest($requestDetails, $validated['notes']);

            return back()->with('status', 'Successfully approved request');
            // return redirect('/approvals')->with('status', 'Successfully approved request' . $requestDetails->ticket_id);
        }

        if ($action == 'rejected') {
            $validated['notes'] = $request->input('rejected_notes');

            // update rejected request status
            $this->updateRejectedRequest($requestDetails, $validated['notes']);

            return back()->with('status', 'Request rejected');
            // return redirect('/approvals')->with('status', 'Request rejected ' . $requestDetails->ticket_id);
        }

        dd($requestDetails);
        // return back()->with('status', 'Successfully updated request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
