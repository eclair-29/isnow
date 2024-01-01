<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\AccountType;
use App\Models\ApplicationType;
use App\Models\Approver;
use App\Models\Request as ModelsRequest;
use App\Models\RequestTracking;
use App\Models\RequestType;
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

    public function getDivisionHead()
    {
        $divisionHead = Approver::with('user')
            ->whereHas('user', function ($query) {
                $query->where('division_id', auth()->user()->division_id);
            })
            ->where('approver_type_id', 2)
            ->first();

        return $divisionHead;
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

    public function getIsHead()
    {
        $isHead = Approver::with('user')
            ->whereHas('user', function ($query) {
                $query->where('dept_id', 1);
            })
            ->where('approver_type_id', 1)
            ->first();

        return $isHead;
    }

    public function getDeptHead()
    {
        $deptHead = Approver::with('user')
            ->whereHas('user', function ($query) {
                $query->where('dept_id', auth()->user()->dept_id);
            })
            ->where('approver_type_id', 1)
            ->first();

        return $deptHead;
    }

    public function getApprovalsDetails(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $deptHead = $this->getDeptHead();
        $divisionHead = $this->getDivisionHead();
        $isHead = $this->getIsHead();
        $requestDetails = $request->requestid ? ModelsRequest::with('status', 'approver', 'requestType', 'applicationType')
            ->findOrFail($request->requestid) : null;

        return [
            'user' => $user,
            'deptHead' => $deptHead,
            'divisionHead' => $divisionHead,
            'isHead' => $isHead,
            'requestDetails' => $requestDetails,
        ];
    }

    public function createRequestTracking($ticketId)
    {
        $ticketDetails = ModelsRequest::select('id', 'user_id', 'status_id', 'approver_id')
            ->where('ticket_id', $ticketId)
            ->first();

        RequestTracking::create([
            'request_id' => $ticketDetails->id,
            'user_id' => $ticketDetails->user_id,
            'approver_id' => $ticketDetails->approver_id,
            'status_id' => $ticketDetails->status_id,
        ]);
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
        $divisionHead = $this->getDivisionHead();
        $deptHead = $this->getDeptHead();
        $dpoHead = $this->getDpoHead();
        $user = User::find(auth()->user()->id);
        $accountTypes = $this->getAccountTypes();

        return view('requestor.create', [
            'applicationTypes' => $applicationTypes,
            'user' => $user,
            'supervisors' => $supervisors,
            'divisionHead' => $divisionHead,
            'deptHead' => $deptHead,
            'dpoHead' => $dpoHead,
            'accountTypes' => $accountTypes,
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
        $this->createRequestTracking($validated['ticket_id']);

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
        $request = ModelsRequest::findOrFail($id)
            ->with('approver', 'requestType', 'status', 'user', 'applicationType')
            ->first();
        $requestTracking = RequestTracking::where('request_id', $id)->get();
        return view('requestor.show', ['request' => $request, 'requestTracking' => $requestTracking]);
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
