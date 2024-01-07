<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Approver;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RequestTracking;
use App\Models\Request as ModelsRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\AccountType;
use App\Models\SalesforceApplication;
use App\Models\SapApplication;
use App\Models\SapRole;
use Illuminate\Support\Facades\DB;
use Throwable;

class ApproverController extends Controller
{
    public function routeForProcessing($requestDetails, $ticket, $notes)
    {
        $requestDetails->update(['status_id' => 4, 'approver_id' => null]);
        createRequestTracking($ticket, 4, null);
    }

    public function updateApprovedRequest(ModelsRequest $requestDetails, $notes)
    {
        $status = $requestDetails->status->id;
        $ticket = $requestDetails->ticket_id;
        $user = $requestDetails->user;

        # approvers
        $deptHead = getDeptHead($user);
        $divisionHead = getDivisionHead($user);
        $isHead = getIsHead();
        $president = getPresident();

        # update request for next approval process
        if ($status == 20) {
            # approved by dept. head
            createRequestTracking($ticket, 21, $notes);
            $requestDetails->update(['status_id' => 23, 'approver_id' => $divisionHead->id]);

            # pending approval for division head
            createRequestTracking($ticket, 23, null);
        }

        if ($status == 23) {
            # approved by division head
            createRequestTracking($ticket, 24, $notes);
            $requestDetails->update(['status_id' => 26, 'approver_id' => $isHead->id]);

            # pending approval for IS head
            createRequestTracking($ticket, 26, null);
        }

        if ($status == 26) {
            # approved by IS head
            createRequestTracking($ticket, 27, $notes);

            $isGlobal = $requestDetails->accountApplication->accountType->type === 'global';
            if ($isGlobal) {
                # route for president approval
                $requestDetails->update(['status_id' => 29, 'approver_id' => $president->id]);
                createRequestTracking($ticket, 29, null);
            } else {
                # route for processing
                $this->routeForProcessing($requestDetails, $ticket, $notes);
            }
        }

        if ($status == 29) {
            # approved by president
            createRequestTracking($ticket, 30, $notes);
            $this->routeForProcessing($requestDetails, $ticket, $notes);
        }

        if ($status == 4) {
            $processor = Approver::where('user_id', auth()->user()->id)->first();

            # save user requested salesforce profiles
            if ($requestDetails->accountApplication->account_type_id == 2) {
                $salesforceApplication = SalesforceApplication::where('account_application_id', $requestDetails->accountApplication->id)->first();

                foreach ($salesforceApplication->salesforce_profiles as $profile)
                    $user->accountTypes()->attach([$profile => ['status' => 'active']]);


                if (count(collect($salesforceApplication->profiles_for_delete)) > 0)
                    foreach ($salesforceApplication->profiles_for_delete as $profile)
                        $user->accountTypes()->sync([$profile => ['status' => 'inactive']], false);
            }

            # save user requested sap roles
            if ($requestDetails->accountApplication->account_type_id == 3) {
                $sapApplication = SapApplication::where('account_application_id', $requestDetails->accountApplication->id)->first();

                foreach ($sapApplication->sap_roles as $role)
                    $user->sapRoles()->attach([$role => ['status' => 'active']]);


                if (count(collect($sapApplication->roles_for_delete)) > 0)
                    foreach ($sapApplication->roles_for_delete as $role)
                        $user->sapRoles()->sync([$role => ['status' => 'inactive']], false);
            }

            # close request
            $requestDetails->update(['status_id' => 44, 'approver_id' => $processor->id]);
            createRequestTracking($ticket, 44, 'Request closed');
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

        if ($status === 29) {
            $requestDetails->update(['status_id' => 31]);
            createRequestTracking($ticket, 31, $notes);
        }

        if ($status === 4) {
            $requestDetails->update(['status_id' => 6]);
            createRequestTracking($ticket, 6, $notes);
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
        $approvalsForProcessing = ModelsRequest::where('status_id', 4)->get();
        return view('approver.index', ['approvals' => $approvals, 'approver' => $approver, 'approvalsForProcessing' => $approvalsForProcessing]);
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
        $approver = Approver::where('user_id', $user->id)->first();
        $disableBtns =
            Str::contains($request->status->description, 'Rejected') ||
            $request->status_id == 44 ||
            ($request->approver == null && $approver->approver_type_id != 5) ||
            ($request->approver != null && $user->id != $request->approver->user->id) ? 'disabled' : '';

        $accountApplication = $request->accountApplication->id;

        # sap application
        $sapApplication = SapApplication::select('sap_roles')
            ->where('account_application_id', $accountApplication)
            ->first();
        $sapRoles = $request->accountApplication->accountType->id == 3
            ? SapRole::select('id', 'description')
            ->whereIn('id', $sapApplication->sap_roles)
            ->get()
            : [];

        # salesforce application
        $salesforceApplication = SalesforceApplication::select('salesforce_profiles')
            ->where('account_application_id', $accountApplication)
            ->first();
        $salesforceProfiles = $request->accountApplication->accountType->id == 2
            ? AccountType::select('id', 'description', 'current_charge')
            ->where('parent_id', 2)
            ->where('is_subtype', 1)
            ->whereIn('id', $salesforceApplication->salesforce_profiles)
            ->get()
            : [];

        return view('approver.show', [
            'request' => $request,
            'requestTracking' => $requestTracking,
            'user' => $user,
            'disableBtns' => $disableBtns,
            'sapRoles' => $sapRoles,
            'salesforceProfiles' => $salesforceProfiles,
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
        $requestDetails = ModelsRequest::with('accountApplication')
            ->findOrFail($id);

        // assign notes value
        if ($action == 'approved') {
            DB::beginTransaction();
            try {
                $validated['notes'] = $request->input('approved_notes');

                // update request for next approval process
                $this->updateApprovedRequest($requestDetails, $validated['notes']);

                DB::commit();
            } catch (Throwable $th) {
                DB::rollBack();
                throw $th;
            }

            return back()->with('status', 'Successfully approved request');
            // return redirect('/approvals')->with('status', 'Successfully approved request' . $requestDetails->ticket_id);
        }

        if ($action == 'rejected') {
            DB::beginTransaction();
            try {
                $validated['notes'] = $request->input('rejected_notes');

                // update rejected request status
                $this->updateRejectedRequest($requestDetails, $validated['notes']);

                DB::commit();
            } catch (Throwable $th) {
                DB::rollBack();
                throw $th;
            }

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
