<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        ChatMessage::create($request->toArray());

        $receiver = User::find($request->user_id);
        $sender = User::find($request->from);

        broadcast(new MessageSent($receiver, $sender, $request->message));

        return response()->noContent();
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
