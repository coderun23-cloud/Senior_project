<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // Validate the password and other fields
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword');
        
        // Check if a profile picture was uploaded and process it
        if (isset($input['profile_picture'])) {
            $profilePicture = $input['profile_picture'];
            
            // Generate a unique name for the profile picture
            $profilePictureName = time() . '.' . $profilePicture->getClientOriginalExtension();
            
            // Move the file to the desired directory
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName);
            
            // If you want to remove the old image, you can delete it here.
            // Check if there's an old image and delete it from the storage
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            // Update the image path in the database
            $user->image = 'profile_pictures/' . $profilePictureName;
        }
        
        // Update the user’s profile information
        $user->forceFill([
            'name' => $input['name'],
            'phone_number' => $input['phone_number'] ?? $user->phone_number, // Keep existing phone number if not updated
            'address' => $input['address'] ?? $user->address, // Keep existing address if not updated
            'password' => Hash::make($input['password']),
            // If a profile picture was uploaded, update the image path
            'image' => isset($input['profile_picture']) ? 'profile_pictures/' . $profilePictureName : $user->image,
        ])->save();
    }
    
}
