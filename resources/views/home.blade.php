@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="mb-3 rounded bg-green-100 p-2 text-green-800">
            {{ session('success') }}
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
                        <td class="flex justify-between border p-2">
                            <span>{{ $product->name }}</span>

                        </td>
                        <td class="border p-2">{{ $product->category }}</td>
                        <td class="flex border p-2 text-center gap-3.5">
                            <!-- Add Sales Data -->
                            <a href="{{ route('add.sales', ['id' => $product->id]) }}"
                                class="text-blue-600 hover:text-blue-800" title="Add Sales Data">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('edit.product', ['id' => $product->id]) }}"
                                class="text-green-600 hover:text-green-800" title="Edit Product">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('destory.product', $product) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete Product">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
