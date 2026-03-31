<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateCallTokenRequest;
use App\Services\AccessToken;
use App\Traits\ApiResponse;

class AgoraController extends Controller
{
    const RoleAttendee = 0;
    const RolePublisher = 1;
    const RoleSubscriber = 2;
    const RoleAdmin = 101;

    public function generateCallToken(GenerateCallTokenRequest $request)
    {
        $data = $request->validated();
        $appID = config('app.agoraVoiceAppID');
        $appCertificate = config('app.agoraVoiceAppCertificate');
        $channelName = $data['channelName'];
        $user = auth()->user()->full_name;
        $uid = auth()->user()->id;
        $role = $this::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        // $token = $this->buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);
        $token = $this->buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
        $result = [
            'token' => $token,
            'expiryInSeconds' => $expireTimeInSeconds
        ];
        return ApiResponse::successResponseWithData($result, 'Agora Token generated', 200);
    }

    public function buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpireTs)
    {
        return $this->buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpireTs);
    }

    public function buildTokenWithUserAccount($appID, $appCertificate, $channelName, $userAccount, $role, $privilegeExpireTs)
    {
        $token = AccessToken::init($appID, $appCertificate, $channelName, $userAccount);
        $Privileges = AccessToken::Privileges;
        $token->addPrivilege($Privileges["kJoinChannel"], $privilegeExpireTs);
        if (($role == $this::RoleAttendee) ||
            ($role == $this::RolePublisher) ||
            ($role == $this::RoleAdmin)
        ) {
            $token->addPrivilege($Privileges["kPublishVideoStream"], $privilegeExpireTs);
            $token->addPrivilege($Privileges["kPublishAudioStream"], $privilegeExpireTs);
            $token->addPrivilege($Privileges["kPublishDataStream"], $privilegeExpireTs);
        }
        return $token->build();
    }
}
