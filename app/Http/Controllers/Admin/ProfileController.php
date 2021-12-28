<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile', [
            'User' => auth('admin')->user()
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:256|email|' . Rule::unique('users')->ignore($request->user_id),
            'password' => 'nullable|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $data = $request->except(['_token']);
        $data['password'] = $data['password'] ? Hash::make($data['password']) : $user->password;

        try {
            $user->update($data);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Profile successfully updated.',
                'redirect' => route('admin.dashboard'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
