<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Resources\JobProposalResource;
use App\Models\JobPosting;
use App\Models\JobProposal;
use App\Models\Merchant;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminProposalController extends Controller
{
    use ApiResponse;

    public function getAllProposals()
    {
        $proposals = JobProposal::orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);
        return ApiResponse::successResponseWithData($proposalResource, "All Job Proposals Retrieved", Response::HTTP_OK);
    }

    public function getSingleProposal(JobProposal $proposal)
    {
        $proposalResource = new JobProposalResource($proposal);
        return ApiResponse::successResponseWithData($proposalResource, "Get Single Proposal Details", Response::HTTP_OK);
    }

    public function getProposalsByMerchant(Merchant $merchant)
    {
        $proposals = JobProposal::where('merchant_id', $merchant->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);
        return ApiResponse::successResponseWithData($proposalResource, "Get Proposals by merchant", Response::HTTP_OK);
    }

    public function getProposalsForJob(JobPosting $job)
    {
        $proposals = JobProposal::where('job_id', $job->id)->orderBy('created_at', 'DESC')->get();
        $proposalResource = JobProposalResource::collection($proposals);
        return ApiResponse::successResponseWithData($proposalResource, "Get Proposals for a Job", Response::HTTP_OK);
    }
}
