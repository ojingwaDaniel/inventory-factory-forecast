@extends('layouts.app')

@section('content')
    <a href="{{ route('home') }}"
        class="mb-4 inline-block rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white shadow transition duration-300 hover:bg-blue-700 hover:shadow-md">
        Go Home
    </a>

    <h2 class="mb-4 text-xl font-semibold">Add Sales Data for {{ $product->name }}</h2>

    @if (isset($success))
        <div class="mb-3 rounded bg-green-100 p-2 text-green-800">
            {{ $success }}
        </div>
    @endif
    @if (session('error'))
        <div class=" b-3 rounded bg-red-100 p-2 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('store.sales', $product->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="mb-1 block font-medium">Month</label>
            <input type="text" name="month" class="w-full rounded border p-2" placeholder="e.g. January">
            @error('month')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-1 block font-medium">Units Sold</label>
            <input type="number" name="units_sold" class="w-full rounded border p-2" placeholder="e.g. 150">
            @error('units_sold')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Save Sales Record
        </button>
    </form>

    <hr class="my-6">

    <h3 class="mb-2 text-lg font-semibold">Existing Sales Data</h3>

    @if ($sales->isEmpty())
        <p>No sales data yet.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Month</th>
                    <th class="border p-2">Units Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td class="border p-2">{{ $sale->month }}</td>
                        <td class="border p-2">{{ $sale->units_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="mt-6 text-center">
        <a href="{{ route('forecast', $product->id) }}"
            class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700">
            View Forecast
        </a>
    </div>

@endsection
