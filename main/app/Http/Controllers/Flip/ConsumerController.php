<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateConsumerRequest;
use App\Http\Resources\UserResource;
use App\Models\Consumer;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsumerController extends Controller
{
    // a function for consumers to update their profile
    public function updateConsumer(UpdateConsumerRequest $request)
    {
        $userID = auth()->user()->id;
        $data = $request->validated();
        $user = User::where('id', $userID)->first();
        $consumer = Consumer::where('user_id', $userID)->first();

        $updateUser = $user->update($data);
        $updateConsumer = $consumer->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Profile updated successfully", Response::HTTP_OK);
    }
}
