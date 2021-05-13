<div>
  <form wire:submit.prevent="save">
    <select wire:model.defer="salesOrder.customer_id">
      <option value="{{ null }}" selected></option>
      @foreach($customers as $customer)
      <option value="{{ $customer->id }}">
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
          <td>{{ $productOptions[$salesOrderDetail['product_id']] }}</td>
          <td>{{ $salesOrderDetail['quantity'] }}</td>
          <td>{{ $salesOrderDetail['unit_price'] }}</td>
          <td>{{ $salesOrderDetail['unit_price'] * $salesOrderDetail['quantity'] }}</td>
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

  <livewire:sales-order.sales-order-detail-modal />

</div>