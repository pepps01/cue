<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $admin = User::where('id', $this->admin_user_id)->first();
        return [
            'logsID' => $this->id,
            'adminUserID' => $this->admin_user_id,
            'adminName' => $admin->fullname,
            'action' => $this->action,
            'modelAffected' => $this->model,
            'modelIDAffected' => $this->model_id,
            'date' => $this->created_at,
        ];
    }
}
