<x-app-layout>
  <x-slot name="header">
    <x-product.product-page-header :product="$product" active="'profile'" />
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <livewire:product.product-form :product="$product" />
    </div>
  </div>
</x-app-layout>