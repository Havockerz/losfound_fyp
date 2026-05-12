<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <a href="{{ route('report.index') }}"
               class="dashboard-btn">
                + Report Item
            </a>
        </div>
    </x-slot>

    <!-- Dashboard Wrapper -->
    <div class="dashboard-container py-10">

        <style>
            .dashboard-container {
                min-height: 100vh;
            }

            .dashboard-card {
                border-radius: 24px;
                padding: 24px;
                background: rgba(255,255,255,0.72);
                backdrop-filter: blur(18px);

                border: 1px solid rgba(255,255,255,0.3);

                box-shadow:
                    0 10px 30px rgba(0,0,0,0.08);

                transition: all 0.3s ease;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow:
                    0 20px 40px rgba(0,0,0,0.12);
            }

            .lost-card {
                border-left: 6px solid #ef4444;
            }

            .found-card {
                border-left: 6px solid #10b981;
            }

            .reunited-card {
                border-left: 6px solid #3b82f6;
            }

            .dashboard-btn {
                display: inline-flex;
                align-items: center;
                padding: 12px 18px;

                border-radius: 14px;

                background: linear-gradient(
                    to right,
                    #6366f1,
                    #8b5cf6
                );

                color: white;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;

                transition: 0.3s ease;
            }

            .dashboard-btn:hover {
                transform: translateY(-2px);
                opacity: 0.9;
            }

            .table-header {
                background: rgba(243,244,246,0.8);
            }

            .status-lost {
                background: #fee2e2;
                color: #b91c1c;
            }

            .status-found {
                background: #dcfce7;
                color: #166534;
            }
        </style>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- LOST -->
                <div class="dashboard-card lost-card">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Lost Items
                    </div>

                    <div class="mt-2 text-4xl font-bold text-gray-900">
                        {{ $totalLost ?? 0 }}
                    </div>
                </div>

                <!-- FOUND -->
                <div class="dashboard-card found-card">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Found Items
                    </div>

                    <div class="mt-2 text-4xl font-bold text-gray-900">
                        {{ $totalFound ?? 0 }}
                    </div>
                </div>

                <!-- REUNITED -->
                <div class="dashboard-card reunited-card">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Reunited
                    </div>

                    <div class="mt-2 text-4xl font-bold text-gray-900">
                        {{ $totalResolved ?? 0 }}
                    </div>
                </div>

            </div>

            <!-- CHARTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- PIE CHART -->
                <div class="dashboard-card">
                    <h3 class="text-lg font-semibold mb-6 text-gray-700 text-center">
                        Lost Items by Category
                    </h3>

                    <div style="height: 300px;">
                        <canvas id="lostItemsChart"></canvas>
                    </div>
                </div>

                <!-- DONUT CHART -->
                <div class="dashboard-card">

                    <h3 class="text-lg font-semibold mb-6 text-gray-700 text-center">
                        Success Rate (Retrieved)
                    </h3>

                    <div style="height: 300px; position: relative;">

                        <canvas id="reunitedDonutChart"></canvas>

                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-5xl font-bold text-blue-600">
                                63%
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RECENT SUBMISSIONS -->
            <div class="dashboard-card">

                <div class="text-gray-900">

                    <h3 class="text-xl font-semibold mb-6 border-b border-gray-200 pb-3">
                        Recent Submissions
                    </h3>

                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead>

                                <tr>

                                    <th class="px-6 py-4 table-header text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Item Name
                                    </th>

                                    <th class="px-6 py-4 table-header text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>

                                    <th class="px-6 py-4 table-header text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>

                                    <th class="px-6 py-4 table-header text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 table-header text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Reported At
                                    </th>

                                    <th class="px-6 py-4 table-header"></th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse($recentItems ?? [] as $item)

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->item_name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->item_type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->type }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm">

                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $item->status === 'lost'
                                                    ? 'status-lost'
                                                    : 'status-found' }}">

                                                {{ ucfirst($item->status) }}

                                            </span>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->created_at->diffForHumans() }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                            <a href="{{ route('report.show', $item->id) }}"
                                               class="text-indigo-600 hover:text-indigo-900 transition">
                                                View Details
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6"
                                            class="px-6 py-10 text-center text-gray-500">

                                            No recent reports found.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    <script>

        // PIE CHART
        const ctxPie =
            document.getElementById('lostItemsChart').getContext('2d');

        new Chart(ctxPie, {

            type: 'pie',

            data: {

                labels: {!! json_encode($chartLabels ?? []) !!},

                datasets: [{

                    data: {!! json_encode($chartData ?? []) !!},

                    backgroundColor: [
                        '#EF4444',
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#6366F1',
                        '#8B5CF6'
                    ],

                    borderWidth: 1

                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }

            }

        });

        // DONUT CHART
        const ctxDonut =
            document.getElementById('reunitedDonutChart').getContext('2d');

        new Chart(ctxDonut, {

            type: 'doughnut',

            data: {

                labels: ['Retrieved', 'Still Missing'],

                datasets: [{

                    data: [63, 37],

                    backgroundColor: [
                        '#046af9',
                        '#ea2e11'
                    ],

                    hoverOffset: 4,

                    cutout: '70%'

                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        });

    </script>

</x-app-layout>
```
