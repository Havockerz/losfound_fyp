<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const monthlyData = @json($monthly);

    if (!monthlyData || monthlyData.length === 0) {
        console.log("No chart data");
        return;
    }

    const labels = monthlyData.map(item => ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"][item.month-1]);
    const lostData = monthlyData.map(item => item.lost);
    const foundData = monthlyData.map(item => item.found);

    const ctx = document.getElementById('statsChart');

    if (!ctx) {
        console.error("Canvas not found");
        return;
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Lost Items',
                    data: lostData,
                    borderColor: '#f87171',
                    backgroundColor: 'rgba(248,113,113,0.2)',
                    tension: 0.4
                },
                {
                    label: 'Found Items',
                    data: foundData,
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96,165,250,0.2)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#ffffff' }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#ffffff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                },
                y: {
                    ticks: { color: '#ffffff' },
                    grid: { color: 'rgba(255,255,255,0.1)' }
                }
            }
        }
    });

});
</script>

<body class="min-h-screen bg-gradient-to-br from-purple-700 via-indigo-600 to-blue-600 flex items-center justify-center">

    <!-- MAIN CONTAINER -->
    <div class="w-full max-w-6xl mx-auto px-6">

        <div class="w-full bg-white/10 backdrop-blur-2xl 
            rounded-3xl p-10 border border-white/20 text-white shadow-2xl">

            <!-- TITLE -->
            <h2 class="text-3xl font-semibold mb-10">
                Dashboard Preview
            </h2>

            <!-- GRID -->
            <div class="grid grid-cols-3 gap-8">

                <!-- LEFT SIDE -->
                <div class="col-span-2 space-y-8">

                    <!-- STATS -->
                    <div class="grid grid-cols-3 gap-6">

                        <div class="p-6 rounded-2xl bg-white/10 border border-white/10">
                            <p class="text-sm text-white/60">Total Lost</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $stats['lost'] }}</h3>
                        </div>

                        <div class="p-6 rounded-2xl bg-white/10 border border-white/10">
                            <p class="text-sm text-white/60">Found Items</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $stats['found'] }}</h3>
                        </div>

                        <div class="p-6 rounded-2xl bg-white/10 border border-white/10">
                            <p class="text-sm text-white/60">Recovered</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $stats['recovered'] }}</h3>
                        </div>

                    </div>

                    <!-- CHART PLACEHOLDER -->
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/10">
                        <p class="text-white/60 text-sm mb-4">Monthly Activity</p>
                        <canvas id="statsChart" height="120"></canvas>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10">

                    <p class="text-white/60 text-sm mb-4">Recent Activity</p>

                    <div class="space-y-4 text-sm">

                        @foreach($recent as $item)
                            <div class="flex justify-between border-b border-white/10 pb-2">
                                <span>{{ $item->location }}</span>
                                <span class="text-white/50 capitalize">
                                    {{ $item->type }}
                                </span>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 text-center">
                <a href="{{ route('auth.merge') }}"
                    class="inline-block px-8 py-3 rounded-xl text-white font-medium no-underline
                    bg-gradient-to-r from-blue-500 to-indigo-600
                    hover:scale-105 hover:shadow-lg transition">
                    Login to View Full Dashboard
                </a>
            </div>

        </div>

    </div>

</body>
</html>

