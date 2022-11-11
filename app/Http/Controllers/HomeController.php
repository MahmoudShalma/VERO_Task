<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $user = User::where("id", Auth::user()->id)->first();
        return view('home', compact("user"));
    }

    public function update(Request $request)
    {


        $validated = $request->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'required',
            'languages' => 'required',
            'certificates' => 'required',
            'mobile' => 'required|numeric|digits:11',
        ]);

        User::where("id", Auth::user()->id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'gender' => $request->gender,
            'country' => $request->country,
            'city' => $request->city,
            'language' => $request->languages,
            'certificates' => $request->certificates,
            'mobile' => $request->mobile,

        ]);
        return redirect()->route('home');
    }
}
