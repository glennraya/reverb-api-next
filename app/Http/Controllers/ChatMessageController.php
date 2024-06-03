<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ChatMessage::create($request->toArray());
    }

    /**
     * Get the messages for the user along with messages count.
     */
    public function getUnreadMessages(Request $request): Collection
    {
        return ChatMessage::with('from')->where('user_id', $request->user_id)
            ->get();
    }
}
