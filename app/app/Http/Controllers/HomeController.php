<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return Renderable
     */
    public function index(): Renderable
    {
        $users = User::where('id', '!=', Auth::id())->get();

        $data = [
          'users' => $users
        ];

        return view('home', $data);
    }

    /**
     * @return RedirectResponse
     */
    public function statusToOnline(): RedirectResponse
    {
        User::find(Auth::id())->update(['status' => 1]);

        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function statusToOffline(): RedirectResponse
    {
        User::find(Auth::id())->update(['status' => 0]);

        return redirect()->back();
    }
}
