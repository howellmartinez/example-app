<x-app-layout>
    <x-slot name="header">
        Edit Sales Order
    </x-slot>
    <livewire:sales-order.sales-order-form :salesOrder="$salesOrder"/>
</x-app-layout>
