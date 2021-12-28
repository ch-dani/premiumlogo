<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function index(Request $request)
    {
        $User = User::all();

        if($request->ajax()){
            return $this->processForDataTable($request, 'User', 'users', ['name' => 'name']);
        }

        return view('admin.users.index', ["User" => $User, "table_columns" => User::$table_columns]);
    }

    /**
     * @return array|mixed
     */
    public function create()
    {
        return view('admin.users.edit');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);

        try {
            $user = User::create($data);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User successfully added.',
                'redirect' => route('admin.users.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param User $User
     * @return array|mixed
     */
    public function edit(User $User)
    {
        return view('admin.users.edit', compact('User'));
    }

    /**
     * @param Request $request
     * @param User $User
     * @return mixed
     */
    public function update(Request $request, User $User)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:256|email|' . Rule::unique('users')->ignore($request->user_id),
            'password' => 'nullable|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);

        try {
            $User->update($data);

            return response()->json([
                'success' => true,
                'data' => $User,
                'message' => 'User successfully updated.',
                'redirect' => route('admin.users.index'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
