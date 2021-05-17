@props(['product', 'active'])
<div>
  <div class="relative pb-5 border-b border-gray-200 sm:pb-0">
    <div class="md:flex md:items-center md:justify-between">
      <h3 class="text-xl leading-6 font-medium text-gray-900">
        {{ $product->name}}
      </h3>
      <div class="mt-3 flex md:mt-0 md:absolute md:top-3 md:right-0">
        <button type="button"
          class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Delete
        </button>
        <button type="button"
          class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Deactivate
        </button>
      </div>
    </div>
    <div class="mt-4">
      <!-- Dropdown menu on small screens -->
      <div class="sm:hidden">
        <label for="current-tab" class="sr-only">Select a tab</label>
        <select id="current-tab" name="current-tab"
          class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option selected>Overview</option>

          <option>Profile</option>

          <option>Movements</option>

        </select>
      </div>
      <!-- Tabs at small breakpoint and up -->
      <div class="hidden sm:block">
        <nav class="-mb-px flex space-x-8"
          x-data="{active: 'border-indigo-500 text-indigo-600', inactive: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'}">
          <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
          <a href="/products/{{ $product->id }}" :class="{{$active}}=='overview' ? active : inactive"
            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
            Overview
          </a>

          <a href="/products/{{ $product->id }}/edit" :class="{{$active}}=='profile' ? active : inactive"
            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
            Profile
          </a>

          <a href="{{ route('product_movements', compact('product')) }}"
            :class="{{$active}}=='movements' ? active : inactive"
            class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
            Movements
          </a>
        </nav>
      </div>
    </div>
  </div>


</div>