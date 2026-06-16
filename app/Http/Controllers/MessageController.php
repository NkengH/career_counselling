<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Appointment;

class MessageController extends Controller
{
    /**
     * Get users the current user is allowed to chat with:
     * - Student -> Their approved counsellors
     * - Counsellor -> Their approved students
     */
    private function getContacts()
    {
        $user = auth()->user();
        $contacts = collect();

        if ($user->role === 'student') {
            $counsellorIds = Appointment::where('student_id', $user->id)
                ->where('status', 'approved')
                ->pluck('counsellor_id')
                ->unique();
            $contacts = User::whereIn('id', $counsellorIds)->get();
        } elseif ($user->role === 'counsellor') {
            $studentIds = Appointment::where('counsellor_id', $user->id)
                ->where('status', 'approved')
                ->pluck('student_id')
                ->unique();
            $contacts = User::whereIn('id', $studentIds)->get();
        }

        return $contacts;
    }

    public function index()
    {
        $contacts = $this->getContacts();
        $activeContact = null;
        $messages = collect();

        return view('messages.index', compact('contacts', 'activeContact', 'messages'));
    }

    public function show(User $user)
    {
        $contacts = $this->getContacts();
        $activeContact = $user;

        // Fetch messages dynamically between these two users
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', auth()->id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', auth()->id());
        })->oldest()->get();

        // Mark incoming messages as read upon viewing chat
        Message::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.index', compact('contacts', 'activeContact', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate(['content' => 'required|string']);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
            'is_read' => false
        ]);

        return redirect()->route('messages.show', $user->id);
    }
}
