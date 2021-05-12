<div>
  <form wire:submit.prevent="save">
    <select wire:model.defer="salesOrder.customer_id">
      <option value="{{ null }}" selected></option>
      @foreach($customers as $customer)
      <option id="{{ $customer->id }}" value="{{ $customer->id }}">
        {{ $customer->name }}
      </option>
      @endforeach
    </select>
    <input type="date" wire:model.defer="salesOrder.date">
    <table>
      <thead>
        <tr>
          <th></th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Line Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($salesOrderDetails as $index => $salesOrderDetail)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ App\Models\Product::find($salesOrderDetail['product_id'])->name }}</td>
          <td>{{ $salesOrderDetail['quantity'] }}</td>
          <td>{{ $salesOrderDetail['unit_price'] }}</td>
          <td>{{ $salesOrderDetail['quantity'] }}</td>
          <td>
            <button type="button" wire:click="remove({{$index}})">Remove</button>
            <button type="button" wire:click="initModal({{$index}})">Edit</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <button type="submit">Save</button>
  </form>
  
  <button type="button" wire:click="initModal">+ Add</button>

  <x-jet-dialog-modal wire:model="showModal">
    <x-slot name="title">
      Sales Order Detail
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
          <select for="product_id" wire:model.defer="modalSalesOrderDetail.product_id">
            <option id="0" value="{{ null }}" selected></option>
            @foreach($products as $product)
            <option id="{{ $product->id }}" value="{{ $product->id }}">
              {{ $product->name }}
            </option>
            @endforeach
          </select>
          <x-jet-input-error for="modalSalesOrderDetail.quantity" class="mt-2" />

          <x-jet-label for="modalSalesOrderDetail.quantity" value="Quantity" />
          <x-jet-input type="number" wire:model.defer="modalSalesOrderDetail.quantity"/>
          <x-jet-input-error for="modalSalesOrderDetail.quantity" class="mt-2" />

          <x-jet-label for="modalSalesOrderDetail.unit_price" value="Unit Price" />
          <x-jet-input type="number" wire:model.defer="modalSalesOrderDetail.unit_price"/>
          <x-jet-input-error for="modalSalesOrderDetail.unit_price" class="mt-2" />

          <x-jet-label for="line_total" value="Line Total" />
          {{ $modalSalesOrderDetail['unit_price'] * $modalSalesOrderDetail['quantity'] }}
          <x-jet-input-error for="modalSalesOrderDetail.line_total" class="mt-2" />
          
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
          Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2"
                    wire:click="saveModal"
                    wire:loading.attr="disabled">
          Okay
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
  
</div>
