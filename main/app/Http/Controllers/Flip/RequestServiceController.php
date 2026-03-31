<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceReviewRequest;
use App\Http\Requests\PayServiceRequest;
use App\Http\Resources\ServiceRequestResource;
use App\Http\Resources\ServiceReviewResource;
use App\Models\Merchant;
use App\Models\Message;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceReview;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestServiceController extends Controller
{
    use ApiResponse;
    use PaymentTraits;

    //consumers service requests
    public function getClientServiceRequests()
    {
        $serviceRequests = ServiceRequest::where('consumer_user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $requestResource = ServiceRequestResource::collection($serviceRequests);
        return ApiResponse::successResponseWithData($requestResource, "My Service requests retrieved Successfully", Response::HTTP_OK);
    }

    public function singleServiceRequest(ServiceRequest $serviceRequest)
    {
        $requestResource = new ServiceRequestResource($serviceRequest);
        return ApiResponse::successResponseWithData($requestResource, "Single Service request retrieved Successfully", Response::HTTP_OK);
    }

    //requesting for a service
    public function serviceRequest(Service $service)
    {
        $data['consumer_user_id'] = auth()->user()->id;
        $data['merchant_user_id'] = $service['user_id'];
        $data['service_id'] = $service['id'];

        if ($service->user_id == auth()->user()->id) {
            return ApiResponse::errorResponse("Cannot request your own service", Response::HTTP_CONFLICT);
        }

        //email merchant to user here

        $request = ServiceRequest::create($data);
        $newMessage = Message::create([
            'sender_user_id' => auth()->user()->id,
            'receiver_user_id' => $service['user_id'],
            'message' => "I would like to request your services as found on your profile. Are you available for the Job?"
        ]);
        $requestResource = new ServiceRequestResource($request);
        return ApiResponse::successResponseWithData($requestResource, "Service Request Sent successfully", Response::HTTP_CREATED);
    }

    public function merchantServiceRequests()
    {
        $serviceRequests = ServiceRequest::where('merchant_user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $requestResource = ServiceRequestResource::collection($serviceRequests);
        return ApiResponse::successResponseWithData($requestResource, "Merchant Service requests retrieved Successfully", Response::HTTP_OK);
    }

    //merchant to accept service request
    public function acceptRequest(ServiceRequest $service)
    {
        if ($service->status != "Requested") {
            return ApiResponse::errorResponse("This request cannot be accepted at the moment", Response::HTTP_BAD_REQUEST);
        }
        $service->update([
            'status' => "Accepted",
            'payment_status' => "Initiated"
        ]);
        return ApiResponse::successResponse("Service Request has been accpeted, awaiting Payment", Response::HTTP_OK);
    }

    //reject a service request
    public function rejectRequest(ServiceRequest $service)
    {
        if ($service->status != "Requested") {
            return ApiResponse::errorResponse("This request cannot be rejected at the moment", Response::HTTP_BAD_REQUEST);
        }
        $service->update([
            'status' => "Rejected",
        ]);
        return ApiResponse::successResponse("Service Request has been rejected", Response::HTTP_OK);
    }

    //client proceeds to make payment for a service
    public function payForService(ServiceRequest $serviceRequest, PayServiceRequest $request)
    {
        $data = $request->validated();

        if ($serviceRequest->payment_status == "Completed") {
            return ApiResponse::errorResponse("Payment has already been made for this service", Response::HTTP_BAD_REQUEST);
        }

        if ($serviceRequest->status != "Accepted") {
            return ApiResponse::errorResponse("Payment can only be made when Service request has been accpeted", Response::HTTP_BAD_REQUEST);
        }

        if ($serviceRequest->payment_status != "Initiated") {
            return ApiResponse::errorResponse("Sorry!, Payment has not been activated yet", Response::HTTP_BAD_REQUEST);
        }

        if ($data['payment_method'] == "wallet") {
            $this->pay_with_wallet($data, "Payment for Service");
        }

        if ($data['payment_method'] == "paystack") {
            $this->pay_with_paystack($data, "Payment for Service");
        }

        if ($data['payment_method'] == "flw") {
            $this->pay_with_flw($data, "Payment for Service");
        }

        if ($data['payment_method'] == "paystack") {
            $this->pay_with_card($data, "Payment for Service");
        }

        $merchantWallet = Wallet::where('user_id', $serviceRequest['merchant_user_id'])->first();
        $merchantWallet->update([
            'escrow_amount' => $merchantWallet['escrow_amount'] + $data['amount']
        ]);
        $serviceRequest->update(['payment_status' => "Completed", 'status' => "Ongoing", 'amountPaid' => $data['amount']]);
        $requestResource = new ServiceRequestResource($serviceRequest);
        return ApiResponse::successResponseWithData($requestResource, "Payment has been completed Successfully", Response::HTTP_OK);
    }

    //mark service as completed after completion and transfer payment to withdrawable
    public function markAsCompleted(ServiceRequest $serviceRequest)
    {
        if ($serviceRequest->status != "Ongoing") {
            return ApiResponse::errorResponse("Sorry, you cannot confirm this service as completed", Response::HTTP_BAD_REQUEST);
        }

        $merchantWallet = Wallet::where('user_id', $serviceRequest['merchant_user_id'])->first();
        $merchantWallet->update([
            'escrow_amount' => $merchantWallet['escrow_amount'] - $serviceRequest['amountPaid'],
            'withdrawable_amount' => $merchantWallet['withdrawable_amount'] + $serviceRequest['amountPaid']
        ]);
        $serviceRequest->update(['status' => "Completed"]);
        $requestResource = new ServiceRequestResource($serviceRequest);
        return ApiResponse::successResponseWithData($requestResource, "Delivery of Service has been confirmed as Completed", Response::HTTP_OK);
    }

    public function reviewService(ServiceRequest $serviceRequest, CreateServiceReviewRequest $request)
    {
        if ($serviceRequest->status != "Completed") {
            return ApiResponse::errorResponse("Service cannot be reviewed until completion", Response::HTTP_OK);
        }
        $user = User::find(auth()->user()->id);
        $data = $request->validated();
        $data['service_id'] = $serviceRequest->service_id;
        $data['merchant_user_id'] = $serviceRequest->merchant_user_id;
        $data['user_id'] = $user['id'];
        $data['reviewer'] = $user['fullname'];

        $review = ServiceReview::create($data);
        $reviewResource = new ServiceReviewResource($review);
        return ApiResponse::successResponseWithData($reviewResource, "Review was sent successfully", Response::HTTP_OK);
    }
}
