<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua user.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data'    => $users
        ]);
    }

    /**
     * Tampilkan detail satu user.
     */
    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'data'    => $user
        ]);
    }

    /**
     * Store a newly created user (Admin side).
     */
    public function store(StoreUserRequest $request)
    {
        // Validasi otomatis dari StoreUserRequest
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data'    => $user
        ], 201);
    }

    /**
     * Update data user.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data'    => $user
        ]);
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
