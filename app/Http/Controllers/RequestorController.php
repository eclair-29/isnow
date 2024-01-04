<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\AccountApplication;
use App\Models\AccountType;
use App\Models\ApplicationType;
use App\Models\Approver;
use App\Models\Request as ModelsRequest;
use App\Models\RequestTracking;
use App\Models\RequestType;
use App\Models\SapApplication;
use App\Models\SapRole;
use App\User;
use Illuminate\Http\Request;

class RequestorController extends Controller
{
    public function getApplicationTypes()
    {
        $applicationTypes = ApplicationType::all();
        return $applicationTypes;
    }

    public function getRequestTypes(Request $request)
    {
        $requestTypes = RequestType::where('application_type_id', $request->apptype)->get();
        return $requestTypes;
    }

    public function generateTicketId(Request $request)
    {
        $applicationTypeId = $request->apptype;
        # Application type ids
        $hrisAppId = 1;
        $accountAppId = 2;
        $joAppId = 3;
        # Current year
        $year = date('y');
        # Get request count based on application type
        $requestCount = ModelsRequest::where('application_type_id', $applicationTypeId)
            ->count();
        $ticketType = '';
        $zeroFilledId = str_pad($requestCount + 1, $requestCount > 9 ? 5 : 4, '0', STR_PAD_LEFT);

        if ($applicationTypeId == $hrisAppId) $ticketType = 'HRIS';
        if ($applicationTypeId == $accountAppId) $ticketType = 'ACCT';
        if ($applicationTypeId == $joAppId) $ticketType = 'JO';

        return $ticketType . $year . $zeroFilledId;
    }

    public function getSupervisors()
    {
        $supervisors = Approver::with('user')
            ->whereHas('user', function ($query) {
                $query->where('division_id', auth()->user()->division_id);
            })
            ->where('approver_type_id', 3)
            ->get();

        return $supervisors;
    }

    public function getDpoHead() // get data privacy officer
    {
        $divisionHead = Approver::with('user')
            ->whereHas('user', function ($query) {
                $query->where('dept_id', 7);
            })
            ->where('approver_type_id', 1)
            ->first();

        return $divisionHead;
    }

    public function getApprovalsDetails(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $deptHead = getDeptHead();
        $divisionHead = getDivisionHead();
        $isHead = getIsHead();
        $requestDetails = $request->requestid ? ModelsRequest::with('status', 'approver', 'requestType', 'applicationType', 'user')
            ->findOrFail($request->requestid) : null;

        // situational due to conditional president approver on account request when selected account type is type 'global'
        $accountType = $request->accountid ? AccountType::select('type')->where('id', $request->accountid)->first() : null;

        return [
            'user' => $user,
            'deptHead' => $deptHead,
            'divisionHead' => $divisionHead,
            'isHead' => $isHead,
            'requestDetails' => $requestDetails,
            'accountType' => $accountType
        ];
    }

    public function getAccountTypes()
    {
        $accountTypes = AccountType::where('is_subtype', 0)->get();
        return $accountTypes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id); # auth user
        $requests = $user->requests;
        return view('requestor.index', ['requests' => $requests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applicationTypes = $this->getApplicationTypes();
        $supervisors = $this->getSupervisors();
        $divisionHead = getDivisionHead();
        $deptHead = getDeptHead();
        $dpoHead = $this->getDpoHead();
        $user = User::find(auth()->user()->id);
        $accountTypes = $this->getAccountTypes();
        $salesforceProfiles = AccountType::select('id', 'description', 'current_charge')
            ->where('parent_id', 2)
            ->where('is_subtype', 1)
            ->get();
        $sapRoles = SapRole::select('id', 'description')->get();

        return view('requestor.create', [
            'applicationTypes' => $applicationTypes,
            'user' => $user,
            'supervisors' => $supervisors,
            'divisionHead' => $divisionHead,
            'deptHead' => $deptHead,
            'dpoHead' => $dpoHead,
            'accountTypes' => $accountTypes,
            'sapRoles' => $sapRoles,
            'salesforceProfiles' => $salesforceProfiles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        # re-assigning: database attribute/col <-> request input name
        $validated['approver_id'] = $request->input('approver');
        $validated['application_type_id'] = $request->input('application_type');
        $validated['request_type_id'] = $request->input('request_type');
        $validated['account_type_id'] = $request->input('account_type');

        ModelsRequest::create($validated);

        # create account application record
        if ($validated['application_type_id'] == '2') {
            $charges = $validated['charges'] = str_replace('¥', '', $request->input('charges'));
            $accountType = $validated['account_type_id'] = $request->input('account_type');
            $requestId = ModelsRequest::select('id')->where('ticket_id', $validated['ticket_id'])->first();

            AccountApplication::create([
                'request_id' => $requestId->id,
                'account_type_id' => $accountType,
                'charges' => $charges,
                'status_id' => $validated['status_id'],
            ]);

            $accountApplicationId = AccountApplication::select('id')->where('request_id', $requestId->id)->first();

            if ($accountType == '3') {
                SapApplication::create([
                    'account_application_id' => $accountApplicationId->id,
                    'sap_roles' => $request->sap_role,
                ]);
            }
        }

        createRequestTracking($validated['ticket_id'], $validated['status_id'], 'Request created');

        return redirect('/requests')->with('status', 'Request successfully created!');
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

        $accountApplication = $request->accountApplication->id;
        $sapApplication = SapApplication::select('sap_roles')
            ->where('account_application_id', $accountApplication)
            ->first();
        $sapRoles = SapRole::select('id', 'description')
            ->whereIn('id', $sapApplication->sap_roles)
            ->get();

        return view('requestor.show', [
            'request' => $request,
            'requestTracking' => $requestTracking,
            'sapRoles' => $sapRoles
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
    public function update(Request $request, $id)
    {
        //
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
