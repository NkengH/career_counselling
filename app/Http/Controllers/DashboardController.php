<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Career;
use App\Models\Appointment;
use App\Models\AptitudeResult;
use App\Models\AptitudeTest;
use App\Models\Recommendation;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'counsellor' => redirect()->route('counsellor.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => redirect('/'),
        };
    }

    public function admin()
    {
        $stats = [
            'total_users' => User::count(),
            'students' => User::where('role', 'student')->count(),
            'counsellors' => User::where('role', 'counsellor')->count(),
            'careers' => Career::count(),
            'tests_completed' => AptitudeResult::count(),
            'appointments' => Appointment::count(),
        ];

        return view('dashboards.admin', compact('stats'));
    }

    public function counsellor()
    {
        $user = auth()->user();

        $stats = [
            'pending_appointments' => Appointment::where('counsellor_id', $user->id)->where('status', 'pending')->count(),
            'confirmed_sessions' => Appointment::where('counsellor_id', $user->id)->where('status', 'approved')->count(),
            'total_students' => User::where('role', 'student')->count(),
        ];

        // Fetch explicit pending requests
        $pendingRequests = Appointment::with('student')->where('counsellor_id', $user->id)->where('status', 'pending')->latest()->get();

        return view('dashboards.counsellor', compact('stats', 'pendingRequests'));
    }

    public function student()
    {
        $user = auth()->user();

        $stats = [
            'tests_taken' => AptitudeResult::where('student_id', $user->id)->count(),
            'recommendations' => Recommendation::where('student_id', $user->id)->count(),
            'upcoming_sessions' => Appointment::where('student_id', $user->id)->whereIn('status', ['approved', 'pending'])->count(),
        ];

        // Ensure defaults so blade progress bars still render empty initially
        $scores = [
            'Logical Reasoning' => 0,
            'Mathematics' => 0,
            'Biology' => 0,
        ];

        $recentResults = AptitudeResult::where('student_id', $user->id)->latest()->take(10)->get();
        // Fetch AI Recommendations
        $recommendations = Recommendation::with('career')->where('student_id', $user->id)->orderByDesc('score')->take(3)->get();

        foreach ($recentResults as $result) {
            if (isset($scores[$result->category])) {
                $scores[$result->category] = $result->score;
            }
        }

        return view('dashboards.student', compact('stats', 'scores', 'recentResults', 'recommendations'));
    }
}
