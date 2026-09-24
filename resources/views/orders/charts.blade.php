<x-app-layout>

    <div style="padding: 24px; max-width: 800px; margin: auto;">

        <h1 style="font-size: 24px; font-weight: 600; margin-bottom: 20px;">Revenue Over Time</h1>

        <canvas id="revenueChart"></canvas>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json($totals),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</x-app-layout>