@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-xl font-semibold"> {{isset($product) ? "Edit Product" : "Add Product"}} </h2>

    <form action="{{isset($product) ? route('update.product',$product) : route("store.product") }}" method="POST" class="space-y-4">
        @csrf
        @isset($product)
         @method("PUT")

        @endisset

        <div>
            <label class="mb-1 block font-medium">Product Name</label>
            <input type="text" name="name" class="w-full rounded border p-2" placeholder="eg. Rice"  value="{{ isset($product ) ? $product->name  : null}}">
            @error('name')
                <p class="mb-3 rounded bg-red-100 p-2 text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-1 block font-medium">Category (optional)</label>
            <input type="text" name="category" class="w-full rounded border p-2" value="{{ isset($product ) ? $product->category  : null}}">
        </div>

        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            {{ isset($product)  ? "Edit Product": "Add Product"}}
        </button>
    </form>
@endsection
