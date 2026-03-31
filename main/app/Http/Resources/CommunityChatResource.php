<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunityChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->image) {
            $image = url('/storage/' . $this->image);
        } else {
            $image = NULL;
        }
        return [
            'postID' => $this->id,
            'message' => $this->message,
            'image' => $this->image,
            'application' => $this->application_name,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            'comments' => count($this->allcomments),
            'allcomments' => CommunityChatCommentResource::collection($this->allcomments),
            'reactions' => $this->reactions,
            'datePosted' => $this->created_at,
            'postedBy' => new UserResource($this->user),
        ];
    }
}
