@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4 text-center">Forecast for {{ $product->name }}</h1>

    <table class="min-w-full bg-gray-50 border mb-6">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Month</th>
                <th class="py-2 px-4 border">Sales Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $s)
                <tr>
                    <td class="py-2 px-4 border">{{ $s->month }}</td>
                    <td class="py-2 px-4 border">{{ $s->units_sold }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        <h2 class="text-xl font-semibold mb-2">📈 Predicted Sales for Next Month:</h2>
        <p class="text-3xl font-bold text-green-600">{{ $forecast }}</p>
        <p class="mt-3 text-gray-700">
        💬 {{ $message }}
    </p>
    </div>
    <div class="bg-gray-50 p-4 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-3 text-center">Sales Trend Chart</h2>
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
                borderColor: 'rgb(37, 99, 235)',  // blue
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

    <div class="mt-6 text-center">
        <a href="{{ route("add.sales",["id"=>$product->id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Back to Sale Data</a>
    </div>
</div>
@endsection



