<x-app-layout>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('master-lists') }}
    </x-slot>

    <x-slot name="header">
        Master Lists
    </x-slot>

    <div class="py-6 grid grid-cols-4 gap-4">
        <a href="{{ route('customer-index') }}">
            <div class="bg-red-500">Customers</div>
        </a>
        <a href="{{ route('product-index') }}">
            <div class="bg-red-500">Products</div>
        </a>
        <div class="bg-red-500">3</div>
        <div class="bg-red-500">4</div>
    </div>

</x-app-layout>