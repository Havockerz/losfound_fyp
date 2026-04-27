<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin: Item Requests</h2>
    </x-slot>
    <div class="py-12 space-y-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 text-red-600 uppercase tracking-wider">
                        Claim Requests (Users claiming found items)
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Claimer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proof/Answer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($claims as $claim)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium">{{ $claim->item->item_name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $claim->user->name ?? 'User' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $claim->verification_answer }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($claim->description, 30) }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($claim->proof_image)
                                                <a href="{{ asset('storage/' . $claim->proof_image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $claim->proof_image) }}" class="h-10 w-10 object-cover rounded border">
                                                </a>
                                            @else
                                                <span class="text-gray-400">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $claim->status }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('admin.claims.approve', $claim->id) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button class="text-green-600 font-bold hover:underline mr-3">Verify</button>
                                            </form>
                                            <form action="{{ route('admin.claims.reject', $claim->id) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button class="text-red-600 font-bold hover:underline">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="p-4 text-center text-gray-400">No claim requests.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4 text-green-600 uppercase tracking-wider">
                        Found Reports (Users who found a lost item)
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lost Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Found By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($foundReports as $report)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium">{{ $report->item->item_name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $report->user->name ?? 'User' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->location_found }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($report->details, 30) }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($report->image)
                                                <a href="{{ asset('storage/' . $report->image) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $report->image) }}" class="h-10 w-10 object-cover rounded border">
                                                </a>
                                            @else
                                                <span class="text-gray-400">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $report->status }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('admin.found.approve', $report->id) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button class="text-green-600 font-bold hover:underline mr-3">Verify</button>
                                            </form>
                                            <form action="{{ route('admin.found.reject', $report->id) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button class="text-red-600 font-bold hover:underline">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="p-4 text-center text-gray-400">No found reports.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>