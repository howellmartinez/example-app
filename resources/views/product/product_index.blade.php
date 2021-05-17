<x-app-layout>

    <x-slot name="header">
        Products
    </x-slot>

    <a href="{{ route('product_create') }}">
        <button type="button">Create</button>
    </a>

    <div class="py-6">
        <livewire:product.product-table />
    </div>

</x-app-layout>