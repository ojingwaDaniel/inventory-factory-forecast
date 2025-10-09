@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-xl font-semibold">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h2>

    <form action="{{ isset($product) ? route('update.product', $product) : route('store.product') }}" method="POST"
        class="space-y-4">
        @csrf
        @isset($product)
            @method('PUT')
        @endisset

        <!-- Product Name -->
        <div>
            <label class="mb-1 block font-medium">Product Name</label>
            <input type="text" name="name" class="w-full rounded border p-2" placeholder="e.g. Rice"
                value="{{ isset($product) ? $product->name : old('name') }}" required minlength="2" maxlength="50"
                pattern="[A-Za-z\s]+" title="Product name should contain only letters and spaces.">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category Dropdown -->
        <div>
            <label class="mb-1 block font-medium">Category (optional)</label>

            <select name="category"
                class="w-full rounded border bg-white p-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                <option value="">-- Select Category --</option>
                @foreach (['Food', 'Snacks', 'Beverage', 'Electronics', 'Stationery', 'Clothing'] as $category)
                    <option value="{{ $category }}"
                        {{ isset($product) && $product->category == $category ? 'selected' : '' }}>{{ $category }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            {{ isset($product) ? 'Update Product' : 'Add Product' }}
        </button>
    </form>
@endsection
