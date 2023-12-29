<?php

namespace App\Http\Controllers;

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
        // $user = User::find(auth()->user()->id);
        // $user->assignRole('approver');

        // $approver = Approver::create([
        //     'name' => 'Stephen Tan',
        //     'user_id' => 5,
        //     'approver_type_id' => 3,

        // ]);

        // $approver->save();
        
        return view('home');
    }
}
