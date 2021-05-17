<x-app-layout>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('sales-deliveries') }}
    </x-slot>

    <x-slot name="header">
        Sales Deliveries
    </x-slot>

    <a href="{{ route('sales_delivery_create') }}">
        <button type="button">Create</button>
    </a>

    <div class="py-6">
        <livewire:sales-delivery.sales-delivery-table />
    </div>

</x-app-layout>