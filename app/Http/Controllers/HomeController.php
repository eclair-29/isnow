<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $user->assignRole('approver');

        $approver = Approver::create([
            'user_id' => auth()->user()->id,
            'approver_type_id' => 1,

        ]);

        $approver->save();

        return view('home');
    }
}
