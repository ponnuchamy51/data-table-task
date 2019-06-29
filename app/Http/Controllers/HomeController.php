<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
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
        $data = User::all();
        return view('home')->withData($data);
    }
    public function edit()
    {
        $userId = request('id');
        $user = User::find($userId)->update([
            "name" => request("name"),
            "email" => request("email"),
            "phone" => request("phone"),
            "sex" => request("sex"),
            "dob" => request("dob"),
        ]);
        $user = User::find($userId);
        return $user;
    }
    public function delete()
    {
        $userId = request('id');
        if ($userId != Auth::user()->id)
        {
            $user = User::find($userId)->delete();
        }
        return $userId;
    }
}
