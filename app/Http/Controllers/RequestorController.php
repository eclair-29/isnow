<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Mail\TicketRequestMail;
use App\Models\AccountApplication;
use App\Models\AccountType;
use App\Models\ApplicationType;
use App\Models\Approver;
use App\Models\Request as ModelsRequest;
use App\Models\RequestTracking;
use App\Models\RequestType;
use App\Models\SalesforceApplication;
use App\Models\SapApplication;
use App\Models\SapRole;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
        $authuser = User::find(auth()->user()->id);
        $requestDetails = $request->requestid ? ModelsRequest::with('status', 'approver', 'requestType', 'applicationType', 'user', 'accountApplication')
            ->findOrFail($request->requestid) : null;
        $requestorId = $requestDetails->user ?? $authuser;
        $deptHead = getDeptHead($requestorId);
        $divisionHead = getDivisionHead($requestorId);
        $isHead = getIsHead($requestorId);
        $president = getPresident($requestorId);

        // situational due to conditional president approver on account request when selected account type is type 'global'
        $accountType = $request->requestid
            ? $requestDetails->accountApplication->accountType->type
            : AccountType::select('type')->where('id', $request->accountid)->first();

        return [
            'user' => $authuser,
            'deptHead' => $deptHead,
            'divisionHead' => $divisionHead,
            'isHead' => $isHead,
            'requestDetails' => $requestDetails,
            'president' => $president,
            'accountType' => $accountType,
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
        $user = User::find(auth()->user()->id);
        $applicationTypes = $this->getApplicationTypes();
        $supervisors = $this->getSupervisors();
        $divisionHead = getDivisionHead($user);
        $deptHead = getDeptHead($user);
        $dpoHead = $this->getDpoHead();
        $accountTypes = $this->getAccountTypes();
        $salesforceProfiles = AccountType::select('id', 'description', 'current_charge')
            ->where('parent_id', 2)
            ->where('is_subtype', 1)
            ->get();
        $sapRoles = SapRole::select('id', 'description')->get();
        $existingSapRoles = $user->sapRoles;
        $existingSalesforceProfiles = $user->accountTypes->where('parent_id', 2);

        return view('requestor.create', [
            'applicationTypes' => $applicationTypes,
            'user' => $user,
            'supervisors' => $supervisors,
            'divisionHead' => $divisionHead,
            'deptHead' => $deptHead,
            'dpoHead' => $dpoHead,
            'accountTypes' => $accountTypes,
            'sapRoles' => $sapRoles,
            'salesforceProfiles' => $salesforceProfiles,
            'existingSapRoles' => $existingSapRoles,
            'existingSalesforceProfiles' => $existingSalesforceProfiles,
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
        DB::beginTransaction();
        try {
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
                $subtypeForDel = collect($request->subtype_for_del)->unique();

                // dd($request->input('subtype_for_del'));

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
                        'roles_for_delete' => $subtypeForDel,
                    ]);
                }

                if ($accountType == '2') {
                    SalesforceApplication::create([
                        'account_application_id' => $accountApplicationId->id,
                        'salesforce_profiles' => $request->salesforce_subtype,
                        'profiles_for_delete' => $subtypeForDel,
                    ]);
                }
            }

            createRequestTracking($validated['ticket_id'], $validated['status_id'], 'Request created');

            $requestMailData = [
                'subject' => '[TICKET APPROVAL] ' . $validated['ticket_id'],
                'body' => 'Request ticket #: ' . $validated['ticket_id'] . ' for approval.',
                'ticketId' => $validated['ticket_id'],
            ];

            Mail::to(['dmgzky@gmail.com'])->send(new TicketRequestMail($requestMailData));

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }

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

        return view('requestor.show', [
            'request' => $request,
            'requestTracking' => $requestTracking,
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
