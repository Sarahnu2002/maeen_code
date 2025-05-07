<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $chats = Chat::where('sender_id', $user->user_id)
            ->orWhere('receiver_id', $user->user_id)
            ->orderBy('dateTime', 'DESC')
            ->take(20)
            ->get();

        return view('chats.index', compact('chats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:User,user_id',
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'dateTime' => now()
        ]);
        return response()->json(['success' => true, 'chat' => $chat]);
    }

    public function getHistory(Request $request)
    {
        $partnerId = $request->query('partner_id');
        $user = Auth::user();
        $history = Chat::where(function ($q) use ($user, $partnerId) {
            $q->where('sender_id', $user->user_id)
                ->where('receiver_id', $partnerId);
        })->orWhere(function ($q) use ($user, $partnerId) {
            $q->where('sender_id', $partnerId)
                ->where('receiver_id', $user->user_id);
        })->orderBy('dateTime')->get();
        return response()->json($history);
    }

    public function getUsers(Request $request)
    {
        $type = $request->query('type');

        // Based on the type, return users who have the corresponding relationship
        if ($type === 'doctor') {
            $users = User::has('doctor')->get(['user_id', 'first_name', 'last_name']);
        } elseif ($type === 'patient') {
            $users = User::has('patient')->get(['user_id', 'first_name', 'last_name']);
        } elseif ($type === 'pharmacist') {
            $users = User::has('pharmacist')->get(['user_id', 'first_name', 'last_name']);
        } else {
            $users = [];
        }
        return response()->json($users);
    }
}
