@extends('layouts.app')

@section('content')
    <a href="{{ route('add.sales', $product->id) }}"
        class="mb-4 inline-block rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white shadow transition duration-300 hover:bg-blue-700 hover:shadow-md">
        Go Back to Sales Data
    </a>

    <h2 class="mb-4 text-xl font-semibold">Edit Sales Data for {{ $product->name }}</h2>

    <form action="{{ route('update.sales', $saleData->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Month Dropdown -->
        <div>
            <label class="mb-1 block font-medium">Month</label>
            <select
                name="month"
                class="w-full rounded border p-2 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                required>
                <option value="">-- Select Month --</option>
                @foreach ([
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ] as $month)
                    <option value="{{ $month }}" {{ $saleData->month === $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>

            @error('month')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <!-- Units Sold -->
        <div>
            <label class="mb-1 block font-medium">Units Sold</label>
            <input
                type="number"
                name="units_sold"
                class="w-full rounded border p-2"
                value="{{ $saleData->units_sold }}"
                required
                min="1"
                placeholder="Enter number of units sold">
            @error('units_sold')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-800">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Update Sales Record
        </button>
    </form>
@endsection
