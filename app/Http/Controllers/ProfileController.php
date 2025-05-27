<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load('educations.edulevel');

        return view('profile.edit', [
            'user' => $request->user(),
            'educations' => $user->educations,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->updated_at = null;
        }

        if ($request->has('domicile')) {
            $user->domicile = $request->input('domicile');
        }

        if ($request->has('gender')) {
            $user->gender = $request->input('gender');
        }
    
        if ($request->has('date_of_birth')) {
            $user->date_of_birth = $request->input('date_of_birth');
        }

        if ($request->hasFile('profile_pic')) {
            // Cek apakah user sudah memiliki foto lama
            if ($user->profile_pic) {
                // Hapus foto lama dari storage
                $oldPhotoPath = storage_path('app/public/' . $user->profile_pic);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // Hapus file foto lama
                }
            }
            // Simpan foto baru
            $path = $request->file('profile_pic')->store('profile_pics', 'public');
            $user->profile_pic = $path; // Simpan nama file ke kolom profile_pic
        }
        
        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

    public function deletePhoto(Request $request)
    {
        $user = $request->user();

        if ($user->profile_pic) {
            $path = storage_path('app/public/' . $user->profile_pic);
            if (file_exists($path)) {
                unlink($path);
            }

            $user->profile_pic = null;
            $user->save();
        }

        return response()->json(['status' => 'success']);
    }
}
