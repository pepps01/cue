<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProposalRequest;
use App\Http\Requests\PayProjectRequest;
use App\Http\Requests\RejectProposalRequest;
use App\Http\Requests\ReviewProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Http\Resources\JobProposalResource;
use App\Models\JobPosting;
use App\Models\JobProposal;
use App\Models\JobProposalMilestone;
use App\Models\Merchant;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Symfony\Component\HttpFoundation\Response;

class ProposalController extends Controller
{
    use ApiResponse;
    use PaymentTraits;

    private function calculate_charges($amount)
    {
        $charges = $amount * env('FLIP_PROPOSAL_CHARGE_PERCENTAGE');
        return $charges;
    }

    public function createProposal(CreateProposalRequest $request, JobPosting $job)
    {
        $data = $request->validated();
        $data['job_id'] = $job['id'];
        $data['consumer_id'] = $job['user_id'];
        $data['merchant_id'] = auth()->user()->id;
        $data['user_id'] = auth()->user()->id;

        $proposal = JobProposal::create($data);
        if ($data['payment_option'] == "by_milestone") {
            $data['num_of_milestones'] = count($data['milestones']);

            foreach ($data['milestones'] as $item) {
                JobProposalMilestone::create([
                    'proposal_id' => $proposal->id,
                    'description' => $item['description'],
                    'due_date' => $item['due_date'],
                    'amount' => $item['amount']
                ]);
                $exp_amount_per_price = $item['amount'] - $this->calculate_charges($item['amount']);
                $proposal->update(['expected_amount' => $proposal['expected_amount'] + $exp_amount_per_price, 'total_price' => $proposal['total_price'] + $item['amount']]);
            }
        } else {
            $proposal->update(['expected_amount' => $data['total_price'] - $this->calculate_charges($data['total_price'])]);
        }

        newNotification(auth()->user()->id, $data['consumer_id'], $proposal->id, 'JobProposal', config('constants.proposal.create.title'), config('constants.proposal.create.message'));

        $proposalResource = new JobProposalResource($proposal);
        return ApiResponse::successResponseWithData($proposalResource, "New proposal created successfully", Response::HTTP_CREATED);
    }

    public function singleProposal(JobProposal $proposal)
    {
        $proposalResource = new JobProposalResource($proposal);
        return ApiResponse::successResponseWithData($proposalResource, "Single proposal detail retrieved", Response::HTTP_OK);
    }

    public function updateProposal(JobProposal $proposal, UpdateProposalRequest $request)
    {
        $data = $request->validated();
        $data['num_of_milestones'] = count($data['milestones']);
        $proposal->update($data);
        if ($data['payment_option'] == "by_milestone") {
            $milestones = JobProposalMilestone::where('proposal_id', $proposal->id)->get();
            if (!$milestones->isEmpty()) {
                foreach ($milestones as $milestone) {
                    $milestone->delete();
                }
            }
            foreach ($data['milestones'] as $item) {
                JobProposalMilestone::create([
                    'proposal_id' => $proposal->id,
                    'description' => $item['description'],
                    'due_date' => $item['due_date'],
                    'amount' => $item['amount']
                ]);
                $exp_amount_per_price = $item['amount'] - $this->calculate_charges($item['amount']);
                $proposal->update(['expected_amount' => $proposal['expected_amount'] + $exp_amount_per_price, 'total_price' => $proposal['total_price'] + $item['amount']]);
            }
        } else {
            $proposal->update(['expected_amount' => $data['total_price'] - $this->calculate_charges($data['total_price'])]);
        }

        newNotification(auth()->user()->id, $proposal->consumer_id, $proposal->id, 'JobProposal', config('constants.proposal.update.title'), config('constants.proposal.update.message'));

        $proposalResource = new JobProposalResource($proposal);
        return ApiResponse::successResponseWithData($proposalResource, "Proposal Terms Updated", Response::HTTP_CREATED);
    }

    public function myProposals()
    {
        $proposals = JobProposal::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);

        return ApiResponse::successResponseWithData($proposalResource, "My proposals retrieved", Response::HTTP_OK);
    }

    public function myProposalsByJob(JobPosting $job)
    {
        $proposals = JobProposal::where('user_id', auth()->user()->id)->where('job_id', $job->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);

        return ApiResponse::successResponseWithData($proposalResource, "My proposals by Job retrieved", Response::HTTP_OK);
    }

    public function withdrawProposal(JobProposal $proposal)
    {
        $proposal->delete();

        newNotification(auth()->user()->id, $proposal->consumer_id, $proposal->id, 'JobProposal', config('constants.proposal.removed.title'), config('constants.proposal.removed.message'));

        return ApiResponse::successResponse("Proposal was removed successfully", Response::HTTP_OK);
    }





    //for customers/clients in need of a digital service only
    public function receivedProposals()
    {
        $proposals = JobProposal::where('consumer_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);
        return ApiResponse::successResponseWithData($proposalResource, "All Received Proposals", Response::HTTP_OK);
    }

    public function proposalsByJob(JobPosting $job)
    {
        $proposals = JobProposal::where('job_id', $job->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);
        return ApiResponse::successResponseWithData($proposalResource, "Proposals for the selected Job Retrieved", Response::HTTP_OK);
    }

    public function acceptProposal(JobProposal $proposal)
    {
        $proposal->update([
            'status' => "Accepted"
        ]);
        if ($proposal->payment_option == "by_milestone") {
            $milestone = JobProposalMilestone::where('proposal_id', $proposal->id)->first();
            $milestone->update([
                'payment_status' => "Current Milestone",
                'status' => "Ongoing"
            ]);
        }
        newNotification(auth()->user()->id, $proposal->merchant_id, $proposal->id, 'JobProposal', config('constants.proposal.accept.title'), config('constants.proposal.accept.message'));

        return ApiResponse::successResponse('Proposal has been Accepted successfully', Response::HTTP_OK);
    }

    public function reviewProposal(JobProposal $proposal, ReviewProposalRequest $request)
    {
        $data = $request->validated();
        $proposal->update([
            'status' => "Review",
            'review_comment' => $data['review_comment']
        ]);

        newNotification(auth()->user()->id, $proposal->merchant_id, $proposal->id, 'JobProposal', config('constants.proposal.review.title'), config('constants.proposal.review.message'));

        return ApiResponse::successResponse("Proposal review was sent successfully", Response::HTTP_OK);
    }

    public function rejectProposal(JobProposal $proposal, RejectProposalRequest $request)
    {
        $data = $request->validated();
        $proposal->update([
            'status' => "Rejected",
            'rejection_reason' => $data['rejection_reason']
        ]);

        newNotification(auth()->user()->id, $proposal->merchant_id, $proposal->id, 'JobProposal', config('constants.proposal.reject.title'), config('constants.proposal.reject.message'));

        return ApiResponse::successResponse('Proposal has been Rejected successfully', Response::HTTP_OK);
    }

    public function payForProject(JobProposal $proposal, PayProjectRequest $request)
    {
        $data = $request->validated();
        if ($proposal->status != "Accepted") {
            return ApiResponse::errorResponse("Proposal must have been accepted before payment is made", Response::HTTP_FORBIDDEN);
        }
        if ($data['payment_method'] == "wallet") {
            $this->pay_with_wallet($data, "Payment for Digital Service");
            $payment = self::paymentOption($proposal, $data);
            if ($payment != "completed") {
                return $payment;
            }
        }
        if ($data['payment_method'] == "paystack") {
            $this->pay_with_paystack($data, "Payment for Digital Service");
            $payment = self::paymentOption($proposal, $data);
            if ($payment != "completed") {
                return $payment;
            }
        }

        if ($data['payment_method'] == "flw") {
            $this->pay_with_flw($data, "Payment for Digital Service");
            $payment = self::paymentOption($proposal, $data);
            if ($payment != "completed") {
                return $payment;
            }
        }

        if ($data['payment_method'] == "card") {
            $this->pay_with_card($data, "Payment for Digital Service");
            $payment = self::paymentOption($proposal, $data);
            if ($payment != "completed") {
                return $payment;
            }
        }

        $proposalResource = new JobProposalResource($proposal);
        return ApiResponse::successResponseWithData($proposalResource, "Payment for Job was completed Successfully", Response::HTTP_ACCEPTED);
    }





    private function paymentOption($proposal, $data)
    {
        if ($proposal->payment_status == "Payment Completed") {
            $payment = ApiResponse::errorResponse("Payment has been completed already", Response::HTTP_BAD_REQUEST);
            return $payment;
        }

        if ($proposal->payment_option == "by_project") {
            if ($proposal->total_price != $data['amount']) {
                $payment = ApiResponse::errorResponse("Amount entered does not tally with the agreed bid price", Response::HTTP_FORBIDDEN);
                return $payment;
            }
            $proposal->update([
                'payment_status' => "Payment Completed",
            ]);
        }
        if ($proposal->payment_option == "by_milestone") {
            $milestone = JobProposalMilestone::where('proposal_id', $proposal->id);
            $lastMilestone = $milestone->orderBy('id', 'DESC')->first();

            //get the current milestone
            $currentMilestone = $milestone->where('payment_status', "Current Milestone")->first();
            if ($currentMilestone['amount'] != $data['amount']) {
                $payment = ApiResponse::errorResponse("Amount entered does not tally with the agreed bid price", Response::HTTP_FORBIDDEN);
                return $payment;
            }
            //update the status of the current milestone
            $currentMilestone->update([
                'payment_status' => "Payment Completed",
                'status' => "Completed"
            ]);

            //if current milestone is not the last milestone move to the next milestone
            if ($currentMilestone['id'] != $lastMilestone['id']) {
                $nextMilestone = JobProposalMilestone::where('proposal_id', $proposal->id)->where('payment_status', "Pending")->first();
                $nextMilestone->update([
                    'payment_status' => "Current Milestone",
                    'status' => "Ongoing"
                ]);
            } else {
                $proposal->update([
                    'payment_status' => "Payment Completed",
                ]);
            }
        }
        //find merchant and add to merchant's balance
        $merchant = Merchant::where('user_id', $proposal->merchant_id)->first();
        $merchantWallet = Wallet::where('user_id', $merchant['user_id'])->first();
        $merchantWallet->update([
            'escrow_amount' => $merchantWallet['escrow_amount'] + $data['amount']
        ]);
        $payment = "completed";
        return $payment;
    }
}
