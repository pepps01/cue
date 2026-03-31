<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunityChatCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $userImage = ($this->user && $this->user->image) ? $this->user->image : null;
        $image = ($this->image) ? $this->image : null;
        return [
            'commentID' => $this->id,
            'postID' => $this->post_id,
            'userID' => $this->user_id,
            'commentBy' => ($this->user && $this->user->fullname) ? $this->user->fullname : null,
            'role' => $this->user && $this->user->role ? $this->user->role : null,
            'message' => $this->message,
            'image' => $image,
            'userImage' => $userImage,
            'date' => $this->created_at
        ];
    }
}
