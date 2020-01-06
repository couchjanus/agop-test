<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Services\ProfileService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('profile.index');
    }

    public function info()
    {
        return view('profile.order');
    }

    public function store(Request $request)
    {
        $this->service->updateInformation($request->all());
        return redirect()->route('home');
    }

    // public function update(Request $request)     {
    //     // $request->user() returns an instance of the authenticated user...
    // }

    public function update(Request $request)
    {
        $data = $request->json()->all();
    }

}
