<?php

namespace App\Http\Controllers;

use App\Models\Item; // Ensure you have an Item model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemReportController extends Controller
{
public function lost()
{
    // We removed 'user_id' to show all items
    // We added 'with('user')' to efficiently load the owner's information
    $items = Item::with('user')
                 ->where('type', 'lost')
                 ->latest()
                 ->get();

    return view('report.lostitem', compact('items'));
}
   public function found()
{
    // 1. Remove the user_id filter to show items from ALL users
    // 2. Add 'with('user')' to load the reporter's name efficiently
    $items = \App\Models\Item::with('user') 
                 ->where('type', 'found')
                 ->latest()
                 ->get();

    return view('report.founditem', compact('items'));
}

    public function index()
{
    // This returns the view where the user fills out the name, location, picture, etc.
    return view('report.index'); 
}

public function store(Request $request)
{
    $request->validate([
        'item_name'     => 'required|string|max:255',
        'description'   => 'required|string',
        'type'          => 'required|in:lost,found', // Validate the type!
        'location'      => 'required|string',
        'reported_date' => 'required|date',
        'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('items', 'public');
    }

    // Save the item using the type from the form
    $item = \App\Models\Item::create([
        'user_id'       => auth()->id(),
        'item_name'     => $request->item_name,
        'description'   => $request->description,
        'type'          => $request->type, // This pulls 'lost' or 'found' from the dropdown
        'location'      => $request->location,
        'reported_date' => $request->reported_date,
        'image'         => $path,
        'status'        => 'pending',
    ]);

    // Redirect based on the type reported
    if ($request->type === 'found') {
        return redirect()->route('report.founditem')->with('success', 'Found item reported successfully!');
    }

    return redirect()->route('report.lostitem')->with('success', 'Lost item reported successfully!');
}

public function show($id)
{
    // We use 'with' to eager load the user who reported the item
    $item = \App\Models\Item::with('user')->findOrFail($id);

    return view('report.show', compact('item'));
}

public function edit($id)
{
    $item = \App\Models\Item::findOrFail($id);

    // Prevent someone from manually typing the URL to edit another person's item
    if ($item->user_id !== auth()->id()) {
        abort(403, 'You are not authorized to edit this item.');
    }

    return view('report.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $item = Item::findOrFail($id);

    // Security check: only the owner can update
    if ($item->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'item_name' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:lost,found',
        'location' => 'required|string',
        'reported_date' => 'required|date',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['item_name', 'description', 'type', 'location', 'reported_date']);

    // Handle new image upload
    if ($request->hasFile('image')) {
        // Optional: delete old image from storage here
        $data['image'] = $request->file('image')->store('items', 'public');
    }

    $item->update($data);

    $route = $item->type === 'found' ? 'report.founditem' : 'report.lostitem';
    return redirect()->route($route)->with('success', 'Report updated successfully!');
}

// Display a single found item
public function foundView($id)
{
    $item = \App\Models\Item::with('user')->findOrFail($id);
    return view('report.foundview', compact('item')); // You will create this blade
}

// Show the edit form for a found item
public function foundEdit($id)
{
    $item = \App\Models\Item::findOrFail($id);

    // Security: Only the owner can edit
    if ($item->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('report.foundedit', compact('item')); // You will create this blade
}

}
