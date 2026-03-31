<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobPostRequest;
use App\Http\Resources\JobPostResource;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    public function createJob(CreateJobRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $jobPost = JobPosting::create($data);
        $jobPostResource = new JobPostResource($jobPost);
        return ApiResponse::successResponseWithData($jobPostResource, "New Job post created Successfully", Response::HTTP_CREATED);
    }

    public function updateJob(UpdateJobPostRequest $request, JobPosting $job)
    {
        $data = $request->validated();
        if ($job['is_active'] == false) {
            return ApiResponse::errorResponse("Job post is not active", Response::HTTP_BAD_REQUEST);
        }
        $job->update($data);
        $jobPostResource = new JobPostResource($job);
        return ApiResponse::successResponseWithData($jobPostResource, "Job post Updated successfully", Response::HTTP_CREATED);
    }

    public function jobsByMe()
    {
        $jobs = JobPosting::where('user_id', auth()->user()->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $jobResource = JobPostResource::collection($jobs);
        return ApiResponse::successResponseWithData($jobResource, "Jobs Posted by Current User retrieved", Response::HTTP_OK);
    }

    public function deactivateJobPost(JobPosting $job)
    {
        if ($job['is_active'] == false) {
            return ApiResponse::errorResponse("Job post is not active", Response::HTTP_BAD_REQUEST);
        }
        $job->update(['is_active' => false]);
        return ApiResponse::successResponse("Job Post has been deactivated", Response::HTTP_OK);
    }

    public function activateJobPost(JobPosting $job)
    {
        if ($job['is_active'] == true) {
            return ApiResponse::errorResponse("Job post is already active", Response::HTTP_BAD_REQUEST);
        }
        $job->update(['is_active' => true]);
        return ApiResponse::successResponse("Job Post has been activated", Response::HTTP_OK);
    }

    public function allJobs()
    {
        $jobs = JobPosting::where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $jobResource = JobPostResource::collection($jobs);
        return ApiResponse::successResponseWithData($jobResource, "All Job post Retrieved", Response::HTTP_OK);
    }

    public function jobsByUserID(User $user)
    {
        $jobs = JobPosting::where('user_id', $user->id)->where('is_active', true)->orderBy('created_at', 'DESC')->get();
        $jobResource = JobPostResource::collection($jobs);
        return ApiResponse::successResponseWithData($jobResource, "Jobs Posted by USERID retrieved", Response::HTTP_OK);
    }

    public function singleJob(JobPosting $job)
    {
        if ($job['is_active'] == false) {
            return ApiResponse::errorResponse("Job post is not active", Response::HTTP_BAD_REQUEST);
        }
        $jobResource = new JobPostResource($job);
        return ApiResponse::successResponseWithData($jobResource, "Job Details retrieved", Response::HTTP_OK);
    }
}
