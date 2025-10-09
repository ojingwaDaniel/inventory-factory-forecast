@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="relative mb-4 rounded-lg border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
            <strong class="font-semibold">Error:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @if (session('success'))
        <div class="relative mb-4 rounded-lg border border-green-400 bg-green-100 px-4 py-3 text-green-700" role="alert">
            <strong class="font-semibold">Success:</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <a href="{{ route('home') }}"
        class="mb-4 inline-block rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white shadow transition duration-300 hover:bg-blue-700 hover:shadow-md">
        Go Home
    </a>

    <h2 class="mb-4 text-xl font-semibold">Add Sales Data for <span class="text-blue-700">{{ $product->name }}</span></h2>

    <form action="{{ route('store.sales', $product->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="mb-1 block font-medium">Month</label>
            <select name="month"
                class="w-full rounded border bg-white p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                <option value="">-- Select Month --</option>
                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach

            </select>

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
                    <th class="border p-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td class="border p-2">{{ $sale->month }}</td>
                        <td class="border p-2">{{ $sale->units_sold }}</td>
                        <td class="flex border p-2 gap-5">
                            <a href="{{ route('edit.sales', ['id' => $sale->id]) }}"
                                class="text-blue-600 underline">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>

                            </a>
                            <form action="{{ route('destory.sales', $sale->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this sales record')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 underline">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>

                                </button>
                            </form>

                        </td>
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
