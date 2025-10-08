@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="mb-3 rounded bg-green-100 p-2 text-green-800">
            {{ session("success")}}
        </div>
    @endif

    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold">All Products</h2>
        <a href="{{ route('add.product') }}" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            + Add Product
        </a>
    </div>

    @if ($products->isEmpty())
        <p>No products yet. Add one to get started!</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">Product Name</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2 flex justify-between">
                            <span>{{ $product->name }}</span>
                            <a href="{{ route("edit.product",["id"=>$product->id]) }}" class="text-blue-600 underline">Edit</a>
                        </td>
                        <td class="border p-2">{{ $product->category }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('add.sales', ['id' => $product->id]) }}" class="text-blue-600 underline">Add
                                Sales Data</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
