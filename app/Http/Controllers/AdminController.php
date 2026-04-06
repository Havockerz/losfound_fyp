<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard Overview
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.dashboard'); 
    }

    /**
     * User Management Page
     */
    public function userManagement()
    {
        // Safety check (Again, though middleware is better!)
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Fetch all users to display in the table
        $users = User::latest()->paginate(10);

        return view('admin.usermanagement', compact('users'));
    }

    public function destroy(\App\Models\User $user)
{
    // Prevent the admin from deleting their own account
    if ($user->id === auth()->id()) {
        return back()->with('error', 'You cannot delete yourself!');
    }

    // Delete the user
    $user->delete();

    // Redirect back with a success message
    return back()->with('success', 'User has been removed successfully.');
}

public function edit(User $user)
{
    if ($user->id === auth()->id()) {
        return redirect()->route('admin.usermanagement')->with('error', 'You cannot edit your own admin account here.');
    }

    return view('admin.useredit', compact('user'));
}

/**
 * Update the user's details.
 */
public function update(Request $request, \App\Models\User $user)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'role'  => 'required|string|in:admin,user,staff', // Adjust roles as needed
        'phone' => 'nullable|string|max:20',
    ]);

    $user->update($validated);

    return redirect()->route('admin.usermanagement')->with('success', 'User updated successfully!');
}

public function userPosts(\App\Models\User $user)
{
    // Assuming your relationship is named 'reports' in the User model
    // If you don't have a relationship, use: ItemReport::where('user_id', $user->id)
    $reports = $user->reports()->latest()->paginate(10);

    return view('admin.userposts', [
        'user' => $user,
        'reports' => $reports
    ]);
}


}