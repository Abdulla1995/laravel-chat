<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function storeMessage(Request $request)
    {
        $user = Auth::user();
        $currentUserId = Auth::user()->id;
        $receiverId = $request->receiver_id;
        $conversationId = [];
        array_push($conversationId, $currentUserId, $receiverId);

        sort($conversationId);
        $uniqueConversationId = $conversationId[0] . $conversationId[1];

        $user->messages()->create(
            [
                'message' => $request->input('message'),
                'receiver_id' => $request->receiver_id,
                'conversation_id' => $uniqueConversationId
            ]
        );

//        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }

    public function getMessages($id)
    {
        $currentUserId = Auth::user()->id;
        $conversationId = [];
        array_push($conversationId, $currentUserId, $id);
        sort($conversationId);

        $uniqueConversationId = $conversationId[0] . $conversationId[1];
        $messages = DB::table('messages', 'desc')
            ->where('conversation_id', $uniqueConversationId)
            ->leftJoin('users', 'users.id', '=', 'messages.user_id')
            ->select('messages.*', 'users.name')->get();
        /*$messages = DB::table('messages', 'desc')
            ->where('receiver_id', $id)
            ->where('user_id', Auth::user()->id)->get();*/
        return $messages;
    }
}
