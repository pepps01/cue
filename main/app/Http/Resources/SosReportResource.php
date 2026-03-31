<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SosReportResource extends JsonResource
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
            'reportID' => $this->id,
            'userID' => $this->user_id,
            'message' => $this->message,
            'reportedFrom' => $this->reported_from,
            'reportTime' => $this->created_at,
            'sosDetails' => new SosResource($this->sos)
        ];
    }
}
