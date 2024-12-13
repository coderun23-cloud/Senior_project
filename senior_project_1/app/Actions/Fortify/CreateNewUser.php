<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Customer;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validate input
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
    
        // Handle profile picture upload using the 'move' method
        $profilePicturePath = null;
        if (isset($input['profile_picture'])) {
            $profilePicture = $input['profile_picture']; // Retrieve the file
            $profilePictureName = time() . '.' . $profilePicture->getClientOriginalExtension(); // Generate unique name
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName); // Move to 'public/profile_pictures'
            $profilePicturePath = 'profile_pictures/' . $profilePictureName; // Path to store in DB
        }
    
        // Create user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'] ?? null,
            'address' => $input['address'] ?? null,
            'image' => $profilePicturePath,
            'password' => Hash::make($input['password']),
        ]);
    
        // Save user details to the customer table (avoid duplication)
        Customer::firstOrCreate(
            ['user_id' => $user->id], // Ensure it's based on user_id to avoid duplicates
            [
                'user_id' => $user->id,
                'address' => $input['address'] ?? null,
                'phone_number' => $input['phone_number'] ?? null,
                'image' => $profilePicturePath
            ]
        );
    
        // Return the created user
        return $user;
    }
    
    
}
