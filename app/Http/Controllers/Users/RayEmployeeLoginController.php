<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RayEmployeeLoginRequest;
use App\Models\Users\RayEmployee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeLoginController extends Controller
{
    public function index()
    {
        $rayStatistics = $this->getLabStatistics(auth()->user());
        return view('users.rayEmployee.dashboard', compact('rayStatistics'));
    }

    public function getLabStatistics(RayEmployee $rayEmployee)
    {
        return [
            'all' => $rayEmployee->rays()->count(),
            'pending' => $rayEmployee->rays()->where('status', 'pending')->count(),
            'completed' => $rayEmployee->rays()->where('status', 'completed')->count(),
        ];
    }

    public function store(RayEmployeeLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME['rayEmployee']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('rayEmployee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
