<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request('user_id') ? __('Posts by User #' . request('user_id')) : __('All Reported Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(request('user_id'))
                    <div class="mb-4">
                        <a href="{{ route('admin.usermanagement') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">
                            &larr; Return To User Management
                        </a>
                    </div>
                @endif

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Reporter</th>
                                <th class="px-6 py-3">Item Name</th>
                                <th class="px-6 py-3">Report Type</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $item->user->name }}</td>
                                    <td class="px-6 py-4 font-bold">{{ $item->item_name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="{{ $item->type === 'lost' ? 'text-red-600' : 'text-green-600' }} font-bold uppercase text-xs">
                                            {{ $item->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ ucfirst($item->status) }}</td>
    <td class="px-6 py-4 flex gap-2">
    <a href="{{ route('report.show', $item->id) }}" class="text-blue-600 hover:underline">View</a>

    @if(auth()->user()->role === 'admin' || auth()->id() === $item->user_id)
        @if($item->type === 'lost')
            <a href="{{ route('report.edit', $item->id) }}"
               class="text-gray-600 hover:underline font-semibold">
                Edit
            </a>
        @elseif($item->type === 'found')
            <a href="{{ route('report.foundedit', $item->id) }}"
               class="text-gray-600 hover:underline font-semibold">
                Edit
            </a>
        @endif
    @endif
</td>
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>