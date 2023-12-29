<?php

namespace App\Http\Controllers;

use App\Models\ApplicationType;
use App\Models\Request as ModelsRequest;
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
        $requestTypes = RequestType::where('application_type_id', $request->application_type_id)->get();
        return $requestTypes;
    }

    public function generateTicketId(Request $request)
    {
        $applicationTypeId = $request->application_type_id;
        # Application type ids
        $hrisAppId = 1;
        $accountAppId = 2;
        $joAppId = 3;
        # Current year
        $year = date('y');
        # Get request count based on application type
        $requestCount = ModelsRequest::where('application_type_id', $applicationTypeId)->count();
        $ticketType = '';
        $zeroFilledId = str_pad($requestCount + 1, $requestCount > 9 ? 5 : 4, '0', STR_PAD_LEFT);

        if ($applicationTypeId == $hrisAppId) $ticketType = 'HRIS';
        if ($applicationTypeId == $accountAppId) $ticketType = 'ACCT';
        if ($applicationTypeId == $joAppId) $ticketType = 'JO';

        return $ticketType . $year . $zeroFilledId;
    }

    public function getSupervisorApprovers()
    {
        $supervisorApprovers = Approver::whereHas('user', function ($query) {
            $query->where('division_id', auth()->user()->division_id);
        })->where('approver_type_id', 3)->get();

        return $supervisorApprovers;
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
        $user = User::find(auth()->user()->id);
        return view('requestor.create', [
            'applicationTypes' => $applicationTypes,
            'user' => $user
        ]);
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
        //
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
