<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reported Lost Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
    <h3 class="text-lg font-medium text-gray-900">{{ __('Items List') }}</h3>
    
    <a href="{{ route('report.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-black focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
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
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->item_name }}" class="w-12 h-12 object-cover rounded-lg shadow-sm">
                @else
                    <div class="w-12 h-12 bg-gray-100 flex items-center justify-center rounded-lg text-[10px] text-gray-400 uppercase">No Image</div>
                @endif
            </td>
            <td class="px-6 py-4 font-bold text-gray-900">{{ $item->item_name }}</td>
            <td class="px-6 py-4 text-xs">{{ Str::limit($item->description, 40) }}</td>
            <td class="px-6 py-4">{{ $item->location }}</td>
            <td class="px-6 py-4 text-nowrap">{{ \Carbon\Carbon::parse($item->reported_date)->format('d M Y') }}</td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->status === 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>

            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('report.show', $item->id) }}" 
                       class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded-md text-xs font-bold uppercase hover:bg-blue-600 hover:text-white transition duration-200">
                        View
                    </a>

                    @if(auth()->id() === $item->user_id)
                        <a href="{{ route('report.edit', $item->id) }}" 
                           class="inline-flex items-center px-3 py-1 border border-amber-500 text-amber-600 rounded-md text-xs font-bold uppercase hover:bg-amber-500 hover:text-white transition duration-200">
                            Edit
                        </a>
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