<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePictureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = User::find(auth()->user()->id);
        return [
            'image' => ['nullable', 'mimes:png,jpg,jpeg,gif,svg,jfif', 'max:10240'],
            'image_encoded' => ['required_if:' . $user->application_name . ',cue,cueDriver', 'string']
        ];
    }
}
