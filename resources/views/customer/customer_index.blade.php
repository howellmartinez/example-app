<x-app-layout>
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('customers') }}
    </x-slot>

    <x-slot name="header">
        Customers
    </x-slot>

    <a href="{{ route('customer_create') }}">
        <button type="button">Create</button>
    </a>

    <div class="py-6">
        <livewire:customer.customer-table />
    </div>

</x-app-layout>