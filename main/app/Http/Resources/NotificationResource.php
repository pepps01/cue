<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notificationID' => $this->id,
            'model' => $this->model,
            'modelID' => $this->model_id,
            'title' => $this->title,
            'message' => $this->message,
            'isRead' => boolval($this->is_read),
            'action' => $this->action,
            'date' => $this->created_at
        ];
    }
}
