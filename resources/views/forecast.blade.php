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

    <div class="mt-6 text-center">
        <a href="{{ route("add.sales",["id"=>$product->id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Back to Sale Data</a>
    </div>
</div>
@endsection



