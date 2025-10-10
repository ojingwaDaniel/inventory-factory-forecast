@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-10 max-w-3xl rounded-lg bg-white p-6 shadow">
        <h1 class="mb-4 text-center text-2xl font-bold">Forecast for {{ $product->name }}</h1>

        <table class="mb-6 min-w-full border bg-gray-50">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Month</th>
                    <th class="border px-4 py-2">Sales Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $s)
                    <tr>
                        <td class="border px-4 py-2">{{ $s->month }}</td>
                        <td class="border px-4 py-2">{{ $s->units_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <h2 class="mb-2 text-xl font-semibold">📈 Predicted Sales for Next Month:</h2>
            <p class="text-3xl font-bold text-green-600">{{ $forecast }}</p>

            @if ($trend > 0)
                <h1 class="text-green-900">Sales are increasing. Keep up the good work!</h1>
            @elseif ($trend < 0)
                <h1 class="text-red-700">Sales are dropping. You may need to improve marketing or reduce costs.</h1>
            @else
                <h1>Sales are stable. Maintain your strategy and watch for changes.</h1>
            @endif

        </div>
        <div class="mb-6 rounded bg-gray-50 p-4 shadow">
            <h2 class="mb-3 text-center text-lg font-semibold">Sales Trend Chart</h2>
            <canvas id="salesChart"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('salesChart');
            const salesMonths = {!! json_encode($sales->pluck('month')) !!};
            const salesUnits = {!! json_encode($sales->pluck('units_sold')) !!};

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [...salesMonths, 'Next Month'],
                    datasets: [{
                        label: 'Units Sold',
                        data: [...salesUnits, {{ $forecast }}],
                        borderColor: 'rgb(37, 99, 235)', // blue
                        backgroundColor: 'rgba(37, 99, 235, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        </script>

        <div class="mt-6 text-center">
            <a href="{{ route('add.sales', ['id' => $product->id]) }}" class="rounded bg-blue-600 px-4 py-2 text-white">Back
                to
                Sale Data</a>
        </div>
    </div>
@endsection
