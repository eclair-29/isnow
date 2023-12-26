<?php

namespace App\Http\Controllers;

use App\Models\ApplicationType;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requestor.index');
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
