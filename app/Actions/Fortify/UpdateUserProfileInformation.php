<?php

namespace App\Actions\Fortify;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        $validated = Validator::make($input, $rules);

        if ($validated->fails()) {
            back()
                ->withInput()
                ->withErrors($validated->errors());
            return;

            Session::flash('error', true);
            Session::flash('message', 'Terjadi kesalahan validasi inputan');
        }

        if (isset($input['avatar'])) {
            if (Storage::disk('public')->exists($user['avatar'])) {
                Storage::disk('public')->delete($user['avatar']);
            }

            $input['avatar'] = upload('avatar', $input['avatar'], 'avatar');
        }

        $user->update($input);

        Session::flash('message', 'Profil berhasil diperbarui');
        Session::flash('success', true);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
