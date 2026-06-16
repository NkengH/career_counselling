<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;

class AppointmentController extends Controller
{
    public function create()
    {
        // Get all permitted counsellors
        $counsellors = User::where('role', 'counsellor')->get();
        return view('student.appointments.create', compact('counsellors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'counsellor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required'
        ]);

        $appointment = Appointment::create([
            'student_id' => auth()->id(),
            'counsellor_id' => $request->counsellor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending'
        ]);

        $counsellor = User::find($request->counsellor_id);
        if ($counsellor) {
            $counsellor->notify(new \App\Notifications\AppointmentBookedNotification($appointment, auth()->user()->name));
        }

        return redirect()->route('student.dashboard')->with('success', 'Your appointment request has been securely sent to the counsellor.');
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Appointment successfully confirmed!');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Appointment request dismissed.');
    }

    public function indexCounsellor()
    {
        $appointments = Appointment::with('student')->where('counsellor_id', auth()->id())->latest()->get();
        // Mark notifications as read when visiting the appointments management page
        auth()->user()->unreadNotifications->markAsRead();
        return view('counsellor.appointments.index', compact('appointments'));
    }
}
