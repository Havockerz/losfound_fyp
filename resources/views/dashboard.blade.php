<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('report.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 
border border-transparent rounded-md font-semibold text-xs text-white uppercase 
tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 
focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                + Report Item
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Lost
                            Items</div>
                        <div class="mt-1 text-3xl font-bold text-gray-900">{{ $totalLost ?? 0 }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Found
                            Items</div>
                        <div class="mt-1 text-3xl font-bold text-gray-900">{{ $totalFound ?? 0 }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Reunited</div>
                        <div class="mt-1 text-3xl font-bold text-gray-900">{{ $totalResolved ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 text-center">Lost Items by
                        Category</h3>
                    <div style="height: 300px;">
                        <canvas id="lostItemsChart"></canvas>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700 text-center">Success Rate
                        (Retrieved)</h3>
                    
                        <div style="height: 300px; position: relative;">
                        <canvas id="reunitedDonutChart"></canvas>
                        
                        <div class="absolute inset-0 flex items-center justify-center">
                             <div class="text-center"></div>
                            <span class="text-5xl font-bold text-blue-600">63%</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Recent Submissions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 
uppercase tracking-wider">Item Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 
uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 
uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 
uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 
uppercase tracking-wider">Reported At</th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentItems ?? [] as $item)
                                                                    <tr>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->item_name }}</td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->item_type }}</td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->type }}</td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $item->status === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                                                {{ ucfirst($item->status) }}
                                                                            </span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                            <a href="{{ route('report.show', $item->id) }}" class="text-indigo-600  hover:text-indigo-900">View Details</a>
                                                                        </td>
                                                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">No recent
                                            reports found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- 1. Lost Items Pie Chart --- 
        const ctxPie = document.getElementById('lostItemsChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartLabels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($chartData ?? []) !!},
                    backgroundColor: ['#EF4444', '#3B82F6', '#10B981', '#F59E0B', '#6366F1', '#8B5CF6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // --- 2. Reunited Donut Chart (Frontend Only) --- 
        const ctxDonut = document.getElementById('reunitedDonutChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Retrieved', 'Still Missing'],
                datasets: [{
                    data: [63, 37], // Hardcoded frontend values 
                    backgroundColor: ['#046af9', '#ea2e11'], // Blue for success, Gray for pending 
                    hoverOffset: 4,
                    cutout: '70%' // This creates the donut hole 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        }); 
    </script>
</x-app-layout>