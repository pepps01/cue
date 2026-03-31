<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEducationRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Requests\UpdateMerchantBusinessRequest;
use App\Http\Requests\UpdateMerchantPersonalRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\MerchantCategoryResource;
use App\Http\Resources\MerchantResource;
use App\Http\Resources\UserResource;
use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\MerchantEducationHistory;
use App\Models\MerchantLanguage;
use App\Models\MerchantProject;
use App\Models\MerchantSkillSet;
use App\Models\MerchantWorkHistory;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MerchantController extends Controller
{
    //view details of a single merchant profile
    public function singleMerchant(Merchant $merchant)
    {
        $user = User::where('id', $merchant->user_id)->first();
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Merchant Information retrieved", Response::HTTP_OK);
    }

    // update merchant profile details by business merchant
    public function updateMerchantBusiness(UpdateMerchantBusinessRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        if ($request->hasFile('cac_document')) {
            $image = $request->file('cac_document');
            $data['cac_document'] = pushFileToStorage($image, 'cac_document');
        }
        if ($request->hasFile('identity_document')) {
            $image = $request->file('identity_document');
            $data['identity_document'] = pushFileToStorage($image, 'identity_document');
        }
        if ($request->hasFile('licence')) {
            $image = $request->file('licence');
            $data['licence'] = pushFileToStorage($image, 'licence');
        }
        $user->update($data);
        $merchant->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Profile updated successfully", Response::HTTP_OK);
    }

    // update merchant profile details by personal merchant
    public function updateMerchantPersonal(UpdateMerchantPersonalRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        $user->update($data);
        $merchant->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Profile updated successfully", Response::HTTP_OK);
    }

    // function for personal merchant to add their skills
    public function addMerchantSkills(UpdateSkillRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();
        $data = $request->validated();

        $skills = MerchantSkillSet::where('merchant_id', $merchant->id);
        if ($skills->count() > 0) {
            $skills->delete();
        }
        foreach ($data['skill'] as $item) {
            MerchantSkillSet::updateOrCreate(['merchant_id' => $merchant->id, 'skill_name' => $item['skill']]);
        }
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Skills Added Successfully", Response::HTTP_OK);
    }

    // function for personal merchant to add their languages
    public function addMerchantLanguages(UpdateLanguageRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();
        $data = $request->validated();

        $languages = MerchantLanguage::where('merchant_id', $merchant->id);
        if ($languages->count() > 0) {
            $languages->delete();
        }
        foreach ($data['language'] as $item) {
            MerchantLanguage::updateOrCreate(['merchant_id' => $merchant->id, 'language' => $item,]);
        }
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Languages Added Successfully", Response::HTTP_OK);
    }

    // function for personal merchant to add their work history
    public function addMerchantWorkHistory(UpdateWorkRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        $data['merchant_id'] = $merchant['id'];
        MerchantWorkHistory::create($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Work History Added Successfully", Response::HTTP_OK);
    }

    // function for personal merchant to add their educational history
    public function addMerchantEducationHistory(UpdateEducationRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        $data['merchant_id'] = $merchant['id'];
        MerchantEducationHistory::create($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Education History added Successfully", Response::HTTP_OK);
    }

    // function for personal merchant to add their previous projects
    public function addMerchantProject(UpdateProjectRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $merchant = Merchant::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        $data['merchant_id'] = $merchant['id'];
        MerchantProject::create($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Project added Successfully", Response::HTTP_OK);
    }



    // function for personal merchant to update their skills
    public function editMerchantSkill(MerchantSkillSet $skill, Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = $request->validate(['skill_name' => ['required', 'string']]);
        $skill->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Skills updated successfully", Response::HTTP_OK);
    }

    // function for personal merchant to update their languages
    public function editMerchantLanguage(MerchantLanguage $language, Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = $request->validate(['language' => ['required', 'string']]);
        $language->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Proficient Languages updated successfully", Response::HTTP_OK);
    }

    // function for personal merchant to update their work history
    public function editMerchantWork(MerchantWorkHistory $work, UpdateWorkRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = $request->validated();
        $work->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Work History updated successfully", Response::HTTP_OK);
    }

    // function for personal merchant to update their education history
    public function editMerchantEducation(MerchantEducationHistory $education, UpdateEducationRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = $request->validated();
        $education->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Education History updated successfully", Response::HTTP_OK);
    }

    // function for personal merchant to update their previous projects
    public function editMerchantProject(MerchantProject $project, UpdateProjectRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = $request->validated();
        $project->update($data);
        $userResource = new UserResource($user);
        return ApiResponse::successResponseWithData($userResource, "Project updated successfully", Response::HTTP_OK);
    }


    // function for personal merchant to remove their skills
    public function removeMerchantSkill(MerchantSkillSet $skill)
    {
        $skill->delete();
        return ApiResponse::successResponse("Skill has been removed successfully", Response::HTTP_OK);
    }

    // function for personal merchant to remove their language
    public function removeMerchantLanguage(MerchantLanguage $language)
    {
        $language->delete();
        return ApiResponse::successResponse("Language has been removed successfully", Response::HTTP_OK);
    }

    // function for personal merchant to remove their work history
    public function removeMerchantWork(MerchantWorkHistory $work)
    {
        $work->delete();
        return ApiResponse::successResponse("Work History has been removed successfully", Response::HTTP_OK);
    }

    // function for personal merchant to remove their education history
    public function removeMerchantEducation(MerchantEducationHistory $education)
    {
        $education->delete();
        return ApiResponse::successResponse("Education History has been removed successfully", Response::HTTP_OK);
    }

    // function for personal merchant to remove their previous projects
    public function removeMerchantProject(MerchantProject $project)
    {
        $project->delete();
        return ApiResponse::successResponse("Project has been removed successfully", Response::HTTP_OK);
    }

    //a method the fetches all active business merchants
    public function allBusinessMerchants()
    {
        $merchants = Merchant::where('merchant_type', "business")->orderBy('created_at', 'DESC')->get();
        $merchantResource = MerchantResource::collection($merchants);
        return ApiResponse::successResponseWithData($merchantResource, "Business Merchants has been retrieved", Response::HTTP_OK);
    }

    //a method the fetches all active personal merchants
    public function allPersonalMerchants()
    {
        $merchants = Merchant::where('merchant_type', "personal")->orderBy('created_at', 'DESC')->get();
        $merchantResource = MerchantResource::collection($merchants);
        return ApiResponse::successResponseWithData($merchantResource, "Personal Merchants has been retrieved", Response::HTTP_OK);
    }

    public function getMerchantCategories()
    {
        $categories = MerchantCategory::orderBy('name')->get();
        $categpryResource = MerchantCategoryResource::collection($categories);
        return ApiResponse::successResponseWithData($categpryResource, "Merchant Categories retrieved", Response::HTTP_OK);
    }

    public function getMerchantByCategories(MerchantCategory $category)
    {
        $merchants = Merchant::where('category_id', $category->id)->orderBy('created_at', 'DESC')->get();
        $merchantResource = MerchantResource::collection($merchants);
        return ApiResponse::successResponseWithData($merchantResource, "All merchants in the " . $category->name . " category", Response::HTTP_OK);
    }
}
