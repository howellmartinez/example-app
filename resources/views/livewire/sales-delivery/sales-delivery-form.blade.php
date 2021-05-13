<div>
  <form wire:submit.prevent="save">
    <select wire:model.defer="salesDelivery.customer_id">
      <option value="{{ null }}" selected></option>
      @foreach($customers as $id => $name)
      <option value="{{ $id }}">
        {{ $name }}
      </option>
      @endforeach
    </select>

    <select wire:model.defer="salesDelivery.warehouse_id">
      <option value="{{ null }}" selected></option>
      @foreach($warehouses as $id => $name)
      <option value="{{ $id }}">{{ $name }}</option>
      @endforeach
    </select>

    <input type="date" wire:model.defer="salesDelivery.date">
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
        @foreach($salesDeliveryDetails as $index => $salesDeliveryDetail)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>
            {{ App\Models\WarehouseProduct::with('product')->find($salesDeliveryDetail['product_warehouse_id'])->product->name }}
          </td>
          <td>{{ $salesDeliveryDetail['quantity'] }}</td>
          <td>{{ $salesDeliveryDetail['unit_price'] }}</td>
          <td>{{ $salesDeliveryDetail['unit_price'] * $salesDeliveryDetail['quantity'] }}</td>
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

  <button type="button" wire:click="initModal">+ Add New</button>
  <button type="button" wire:click="initSalesOrderDetailTableModal">+ Add from SO</button>

  <livewire:sales-delivery.sales-delivery-detail-modal />
  <livewire:sales-delivery.sales-order-detail-table-modal />

</div>