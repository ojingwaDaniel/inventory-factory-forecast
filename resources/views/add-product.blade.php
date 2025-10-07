@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-xl font-semibold">Add New Product</h2>

    <form action="{{ route('store.product') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="mb-1 block font-medium">Product Name</label>
            <input type="text" name="name" class="w-full rounded border p-2" placeholder="e.g. Rice">
            @error('name')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-1 block font-medium">Category (optional)</label>
            <input type="text" name="category" class="w-full rounded border p-2" placeholder="e.g. Food">
        </div>

        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Save Product
        </button>
    </form>
@endsection
