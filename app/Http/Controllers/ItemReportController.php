<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ItemReportController extends Controller
{
    use AuthorizesRequests;
    public function lost(Request $request) // Added Request here
    {
        $items = Item::with('user')
            ->where('type', 'lost')
            // Add this filter: only filter if user_id is present in the URL
            ->when($request->query('user_id'), function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        return view('report.lostitem', compact('items'));
    }

    public function found(Request $request) // Added Request here
    {
        $items = \App\Models\Item::with('user')
            ->where('type', 'found')
            // Add this filter: only filter if user_id is present in the URL
            ->when($request->query('user_id'), function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
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
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:lost,found',
            'item_type' => 'required|string|max:255',
            'location' => 'required|string',
            'reported_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
        }

        // Save the item using the type from the form
        $item = \App\Models\Item::create([
            'user_id' => auth()->id(),
            'item_name' => $request->item_name,
            'description' => $request->description,
            'type' => $request->type, // This pulls 'lost' or 'found' from the dropdown
            'item_type' => $request->item_type,
            'location' => $request->location,
            'reported_date' => $request->reported_date,
            'image' => $path,
            'status' => 'pending',
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

    public function edit(Item $item)
    {
        if (auth()->user()->id !== $item->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('report.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        // 1. Authorization check (Keep this as is) 
        if (auth()->user()->id !== $item->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }
        // 2. Validation (Added 'image' to the list) 
        $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Added this 
        ]);
        // 3. Prepare data for update 
        $data = [
            'item_name' => $request->item_name,
            'description' => $request->description,
            'type' => $request->type,
            'item_type' => $request->item_type,
            'location' => $request->location,
            'reported_date' => $request->reported_date,
        ];
        // 4. IMAGE HANDLING BLOCK (The missing part) 
        if ($request->hasFile('image')) {
            // Delete the old file from storage if it exists 
            if ($item->image && \Storage::disk('public')->exists($item->image)) {
                \Storage::disk('public')->delete($item->image);
            }
            // Store new file in 'public/items' folder 
            $path = $request->file('image')->store('items', 'public');
            $data['image'] = $path;
        }
        // 5. Save everything to database 
        $item->update($data);
        // 6. Dynamic Redirect (Keep your existing logic) 
        if (auth()->user()->role === 'admin') {
            $url = route('admin.postmanagement');
        } else {
            $url = $item->type === 'lost'
                ? route('report.lostitem')
                : route('report.founditem');
        }
        return redirect($url)->with('success', 'Report updated successfully!');
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
        // Find the item first
        $item = \App\Models\Item::findOrFail($id);

        // Allow admin or owner
        if (auth()->user()->role !== 'admin' && auth()->id() !== $item->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Return the view with the item
        return view('report.foundedit', compact('item'));
    }

    public function allPosts(Request $request)
    {
        $query = \App\Models\Item::with('user');

        // If an Admin clicked "Posts" from the User Management table
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $items = $query->latest()->paginate(15);

        return view('admin.postmanagement', compact('items'));
    }

    public function destroy(Item $item)
    {
        // 1. Authorization: Only the owner or an admin can delete 
        if (auth()->user()->id !== $item->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }
        // 2. Delete the associated image from storage 
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        // 3. Delete the record from the database 
        $item->delete();
        // 4. Redirect back with a success message 
        return back()->with('success', 'Report deleted successfully!'); 
} 

}
