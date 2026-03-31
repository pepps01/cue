<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobPostRequest;
use App\Http\Resources\JobPostResource;
use App\Models\JobPosting;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminJobController extends Controller
{
    use ApiResponse;

    public function getAllJobs()
    {
        $jobs = JobPosting::orderBy('created_at', 'DESC')->get();
        $jobResource = JobPostResource::collection($jobs);
        return ApiResponse::successResponseWithData($jobResource, "All Jobs retrieved", Response::HTTP_OK);
    }

    public function getJobsByUser(User $user)
    {
        $jobs = JobPosting::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $jobResource = JobPostResource::collection($jobs);
        return ApiResponse::successResponseWithData($jobResource, "All Jobs posted by: " . $user->fullname, Response::HTTP_OK);
    }

    public function getSingleJob(JobPosting $job)
    {
        $jobResource = new JobPostResource($job);
        return ApiResponse::successResponseWithData($jobResource, "Single Job post details retrieved", Response::HTTP_OK);
    }

    public function createJob(User $user, CreateJobRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $jobPost = JobPosting::create($data);
        $jobResource = new JobPostResource($jobPost);
        saveAdminActivityLog("job_post_created", "JobPosting", $jobPost->id);
        return ApiResponse::successResponseWithData($jobResource, "New Job post created Successfully", Response::HTTP_CREATED);
    }

    public function updateJob(UpdateJobPostRequest $request, JobPosting $job)
    {
        $data = $request->validated();
        $job->update($data);
        $jobResource = new JobPostResource($job);
        saveAdminActivityLog("job_post_created", "JobPosting", $job->id);
        return ApiResponse::successResponseWithData($jobResource, "Job post Updated successfully", Response::HTTP_CREATED);
    }

    public function deactivateJobPost(JobPosting $job)
    {
        if ($job['is_active'] == false) {
            return ApiResponse::errorResponse("Job post is not active", Response::HTTP_BAD_REQUEST);
        }
        $job->update(['is_active' => false]);
        saveAdminActivityLog("job_post_deactivated", "JobPosting", $job->id);
        return ApiResponse::successResponse("Job Post has been deactivated", Response::HTTP_OK);
    }

    public function activateJobPost(JobPosting $job)
    {
        if ($job['is_active'] == true) {
            return ApiResponse::errorResponse("Job post is already active", Response::HTTP_BAD_REQUEST);
        }
        $job->update(['is_active' => true]);
        saveAdminActivityLog("job_post_activated", "JobPosting", $job->id);
        return ApiResponse::successResponse("Job Post has been activated", Response::HTTP_OK);
    }

    public function deleteJobPost(JobPosting $job)
    {
        $job->delete();
        saveAdminActivityLog("job_post_deleted", "JobPosting", $job->id);
        return ApiResponse::successResponse("Job posting was deleted successfully", Response::HTTP_OK);
    }
}
