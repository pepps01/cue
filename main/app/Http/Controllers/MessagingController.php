<?php

namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\MessageChat;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagingController extends Controller
{
    use ApiResponse, Generics;

    public function sendMessage(SendMessageRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['sender_user_id'] = auth()->user()->id;
        $data['receiver_user_id'] = $user->id;

        //check for existing chats between the two users, if it exists add message to existing chat else create new chat
        $old_messages = Message::where('sender_user_id', auth()->user()->id)->where('receiver_user_id', $user->id)->first();
        if (!$old_messages) {
            $chat = $this->createNewChat($data);
            $data['chat_id'] = $chat->id;
        } else {
            $data['chat_id'] = $old_messages->chat_id;
        }

        $message = Message::create($data);

        //Dispatch an event for a new message
        event(new NewMessageEvent($message));

        $messageResource = new MessageResource($message);
        return ApiResponse::successResponseWithData($messageResource, "Message Sent Successfully", Response::HTTP_CREATED);
    }

    public function replyMessage(SendMessageRequest $request, string $chatID)
    {
        $data = $request->validated();
        $chat = Message::where('chat_id', $chatID)->first();
        if (!$chat) {
            return ApiResponse::errorResponse("Chat not Found", Response::HTTP_NOT_FOUND);
        }
        $data['user_id'] = auth()->user()->id;
        $data['sender_user_id'] = auth()->user()->id;
        $data['receiver_user_id'] = $chat['sender_user_id'];
        $data['chat_id'] = $chatID;

        $message = Message::create($data);

        //Dispatch an event for a new message
        event(new NewMessageEvent($message));

        $messageResource = new MessageResource($message);
        return ApiResponse::successResponseWithData($messageResource, "Message Sent Successfully", Response::HTTP_CREATED);
    }

    public function getChats()
    {
        $chats = MessageChat::where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->get();
        $chatResource = ChatResource::collection($chats);
        return ApiResponse::successResponseWithData($chatResource, "Chats Retrieved successfully", Response::HTTP_OK);
    }

    public function chatWithUser(User $user)
    {
        $chat = Message::where('sender_user_id', auth()->user()->id)->where('receiver_user_id', $user->id)
            ->orWhere('sender_user_id', $user->id)->where('receiver_user_id', auth()->user()->id)
            ->get();
        $messageResource = MessageResource::collection($chat);
        return ApiResponse::successResponseWithData($messageResource, "Chat with " . $user->firstname . " retrieved", Response::HTTP_OK);
    }

    private function createNewChat($data)
    {
        $newChat = [];
        $newChat['chat_code'] = $this->createUniqueID('messages', 'chat_id');
        $newChat['sender_id'] = $data['sender_user_id'];
        $newChat['receiver_id'] = $data['receiver_user_id'];
        $chat = MessageChat::create($newChat);
        return $chat;
    }
}
