<x-app-layout>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('sales-orders') }}
    </x-slot>

    <x-slot name="header">
        Sales Orders
    </x-slot>

    <div class="py-6">
        <livewire:sales-order.sales-order-table />
    </div>

</x-app-layout>