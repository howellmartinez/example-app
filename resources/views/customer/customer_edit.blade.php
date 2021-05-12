<x-app-layout>
    <x-slot name="header">
      <x-customer.customer-page-header :customer="$customer" active="'profile'"/>
    </x-slot>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"> 
        <livewire:customer.customer-form :customer="$customer"/>
      </div>
    </div>
</x-app-layout>
