<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request('user_id') ? __('Items Reported by User #' . request('user_id')) : __('Reported Lost Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(request('user_id'))
                <div
                    class="mb-4 p-4 bg-amber-50 border-l-4 border-amber-400 text-amber-700 flex justify-between items-center shadow-sm rounded-r-lg">
                    <div>
                        <span class="font-bold">Admin Mode:</span> Viewing items for a specific user.
                    </div>
                    <a href="{{ route('report.lostitem') }}"
                        class="text-xs bg-amber-200 px-2 py-1 rounded hover:bg-amber-300 transition uppercase font-bold text-amber-800">
                        Show All Items
                    </a>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Lost Item List') }}</h3>
                    <a href="{{ route('report.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-black rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition shadow-sm">

                        {{ __('Report A Lost Item') }}
                    </a>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Picture</th>
                                <th class="px-6 py-3">Item Name</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3">Item Type</th>
                                <th class="px-6 py-3">Location</th>
                                <th class="px-6 py-3">Date Reported</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr class="bg-white border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->item_name }}"
                                                class="w-12 h-12 object-cover rounded-lg shadow-sm">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-gray-100 flex items-center justify-center rounded-lg text-[10px] text-gray-400 uppercase">
                                                No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $item->item_name }}</td>
                                    <td class="px-6 py-4 text-xs">{{ Str::limit($item->description, 40) }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $item->item_type }}</td>
                                    <td class="px-6 py-4">{{ $item->location }}</td>
                                    <td class="px-6 py-4 text-nowrap">
                                        {{ \Carbon\Carbon::parse($item->reported_date)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->status === 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                                                    <div class="flex items-center justify-center gap-3">
                                                                        <a href="{{ route('report.show', $item->id) }}" class="inline-flex items-center px-3 py-1 
                                                                        border border-blue-500 
                                                                        text-blue-600 rounded-md text-xs font-bold uppercase 
                                                                        hover:bg-blue-600 hover:text-white transition duration-200">View
                                                                        </a>
                                                                        @if(auth()->user()->role === 'admin' || auth()->id() === $item->user_id)
                                                                            <a href="{{ route('report.edit', $item->id) }}" class="inline-flex items-center px-3 py-1 
                                                                            border border-amber-500 
                                                                            text-amber-600 rounded-md text-xs font-bold uppercase 
                                                                            hover:bg-amber-500 hover:text-white transition duration-200">Edit
                                                                            </a>
                                                                        
                                                                        <form action="{{ route('report.destroy', $item->id) }}" method="POST"
                                                                              onsubmit="return confirm('Are you sure you want to delete this report?');" class="inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                            <button type="submit" class="inline-flex items-center px-3 py-1 
                                                                            border border-red-500 text-red-600 rounded-md text-xs font-bold uppercase 
                                                                            hover:bg-red-500 hover:text-white transition duration-200">Delete
                                                                            </button>
                                                                        </form>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>