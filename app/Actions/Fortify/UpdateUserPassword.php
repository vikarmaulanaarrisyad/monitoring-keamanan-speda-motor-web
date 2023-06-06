<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $validated = Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.string' => 'Password lama bertipe text.',
            'password.string' => 'Password harus bertipe text.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password wajib diisi.',
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });

        if ($validated->fails()) {
            back()->withErrors($validated->errors());
            Session::flash('error', true);
            Session::flash('message', 'Terjadi kesalahan validasi inputan');
            return;
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        Session::flash('message', 'Password berhasil diperbarui');
        Session::flash('success', true);
    }
}
