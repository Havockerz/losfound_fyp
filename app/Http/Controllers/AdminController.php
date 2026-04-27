<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Claim;
use App\Models\FoundReport;
use App\Notifications\RequestApproved;  
use App\Notifications\RequestRejected; 

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
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::latest()->paginate(10);
        return view('admin.usermanagement', compact('users'));
    }

    public function destroy(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }
        $user->delete();
        return back()->with('success', 'User has been removed successfully.');
    }

    public function edit(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.usermanagement')->with('error', 'You cannot edit your own admin account here.');
        }
        return view('admin.useredit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,user,staff',
            'phone' => 'nullable|string|max:20',
        ]);
        $user->update($validated);
        return redirect()->route('admin.usermanagement')->with('success', 'User updated successfully!');
    }

    public function userPosts(\App\Models\User $user)
    {
        $reports = $user->reports()->latest()->paginate(10);
        return view('admin.userposts', compact('user', 'reports'));
    }

    /** 
     * View all claim and found item requests 
     */
    public function manageRequests()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only get claims that are still 'pending' 
        $claims = Claim::with(['user', 'item'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        // Only get found reports that are still 'pending' 
        // (Assuming 'pending' is your default status before 'verified' or 'rejected') 
        $foundReports = FoundReport::with(['user', 'item'])->where('status', 'pending')->latest()->paginate(10);
        return view('admin.requests', compact('claims', 'foundReports'));
    }

    /** 
     * Approve a claim request 
     */
    public function approveClaim($id) 
{ 
    $claim = Claim::with(['user', 'item.user'])->findOrFail($id); 
    $claim->update(['status' => 'approved']); 
    $claim->item->update(['status' => 'reunited']); 

    $owner = $claim->user;  
    $finder = $claim->item->user;  
    $itemName = $claim->item->item_name; 

    $owner->notify(new RequestApproved($finder, $itemName)); 
    usleep(1500000);  // Wait 1.5 seconds for Mailtrap rate limiting
    $finder->notify(new RequestApproved($owner, $itemName)); 

    return back()->with('success', 'Claim approved! Both parties notified.'); 
} 

    /** 
     * Reject a claim request 
     */
    public function rejectClaim($id) 
    { 
        $claim = Claim::with(['user'])->findOrFail($id); 
        $claim->update(['status' => 'rejected']); 

        // Only notify the person who tried to claim it 
        $claim->user->notify(new RequestRejected($claim->item->item_name ?? 'Item')); 

        return back()->with('error', 'The claim has been rejected.'); 
    }

    public function approveFound($id)
    {
        $report = FoundReport::findOrFail($id);
        $report->update(['status' => 'verified']);
        return back()->with('success', 'Found report verified successfully.');
    }

    public function rejectFound($id)
    {
        $report = FoundReport::findOrFail($id);
        $report->update(['status' => 'rejected']);
        return back()->with('status', 'Found report rejected.');
    }
}