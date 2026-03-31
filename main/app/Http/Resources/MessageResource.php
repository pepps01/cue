<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'messageID' => $this->id,
            'chatID' => $this->chat_id,
            'userID' => auth()->user()->id,
            'senderID' => $this->sender_user_id,
            'receiverID' => $this->receiver_user_id,
            'message' => $this->message,
            'date' => $this->created_at
        ];
    }
}
