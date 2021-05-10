<div>
  <form wire:submit.prevent="save">
    <select wire:model="salesOrder.customer_id">
      <option value="{{ null }}" selected></option>
      @foreach($customers as $customer)
      <option id="{{ $customer->id }}" value="{{ $customer->id }}">
        {{ $customer->name }}
      </option>
      @endforeach
    </select>
    <input type="date" wire:model="salesOrder.date">
    <ul>
    @foreach($salesOrderDetails as $salesOrderDetail)
    <li>{{ $salesOrderDetail->productId }}</li>
    @endforeach
    </ul>
    <button type="submit">Save</button>
  </form>
</div>
