<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\DoctorLoginRequest;
use App\Models\Users\Doctor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    public function index()
    {
        $statistics = $this->getStatistics(auth()->user());
        return view('users.doctor.dashboard', compact('statistics'));
    }

    public function getStatistics(Doctor $doctor)
    {
        return [
            'all' => [
                'patients' => $doctor->patients()->count(),
                'appointments' => $doctor->appointments()->count(),
                'diagnostics' => $doctor->diagnostics()->count(),
            ],
            'pending' => [
                'appointments' => $doctor->appointments()->where('status', 'pending')->count(),
                'diagnostics' => $doctor->diagnostics()->where('status', 'pending')->count(),
            ],
            'in-progress' => [
                'appointments' => $doctor->appointments()->where('status', 'in-progress')->count(),
                'diagnostics' => $doctor->diagnostics()->where('status', 'in-progress')->count(),
            ],
            'completed' => [
                'appointments' => $doctor->appointments()->where('status', 'completed')->count(),
                'diagnostics' => $doctor->diagnostics()->where('status', 'completed')->count(),
            ],
        ];
    }

    public function store(DoctorLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME['doctor']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
