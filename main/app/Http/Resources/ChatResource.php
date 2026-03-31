<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->sender->image) {
            $imageSender = url('/storage/' . $this->sender->image);
        } else {
            $imageSender = NULL;
        }
        if ($this->receiver->image) {
            $imageReceiver = url('/storage/' . $this->receiver->image);
        } else {
            $imageReceiver = NULL;
        }
        return [
            'chat' => [
                'chatId' => $this->id,
                'chatCode' => $this->chat_code,
                'sender' => [
                    'userID' => $this->sender->id,
                    'name' => $this->sender->fullname,
                    'image' => $this->sender->image
                ],
                'receiver' => [
                    'userID' => $this->receiver->id,
                    'name' => $this->receiver->fullname,
                    'image' => $this->receiver->image
                ],
                'messages' => MessageResource::collection($this->messages)
            ]
        ];
    }
}
