<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Details') }} - {{ $item->item_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-700 uppercase tracking-wider">Item Image</h3>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-full h-auto rounded-lg shadow-md border">
                        @else
                            <div
                                class="w-full h-64 bg-gray-100 flex items-center justify-center rounded-lg border-2 border-dashed">
                                <span class="text-gray-400 italic">No image provided</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-700 uppercase tracking-wider">Information</h3>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Item Name</label>
                            <p class="text-gray-900 font-medium">{{ $item->item_name }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Item Type</label>
                            <p class="text-gray-900 font-medium">{{ $item->item_type }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Status</label>
                            <p>
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->status === 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Location</label>
                            <p class="text-gray-900 font-medium">{{ $item->location }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Date Reported</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($item->reported_date)->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Description</label>
                            <p class="text-gray-700 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-10 border-gray-200">

                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                    <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Contact Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <label class="block text-blue-700 font-bold uppercase text-[10px]">Reported By</label>
                            <p class="text-gray-900 text-base">{{ $item->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-blue-700 font-bold uppercase text-[10px]">Email Address</label>
                            <p class="text-gray-900 text-base">{{ $item->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-blue-700 font-bold uppercase text-[10px]">Phone Number</label>
                            <p class="text-gray-900 text-base">{{ $item->user->phone ?? 'Not Provided' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="javascript:history.back()"
                        class="text-gray-600 hover:text-gray-900 font-medium transition">
                        &larr; Back to List
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>