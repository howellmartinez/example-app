<div>
  <x-jet-dialog-modal wire:model="show">
    <x-slot name="title">
      Sales Order Details
    </x-slot>

    <x-slot name="content">
      <div class="mt-4">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Product</th>
              <th>Ordered</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($salesOrderDetails as $index => $salesOrderDetail)
            <tr>
              <td>{{ $salesOrderDetail->salesOrder->date }}</td>
              <td>{{ $salesOrderDetail->product->name }}</td>
              <td>{{ $salesOrderDetail->quantity }}</td>
              <td><input type="number" wire:model="salesOrderDetails.{{$index}}.to_deliver" /></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('show')" wire:loading.attr="disabled">
        Cancel
      </x-jet-secondary-button>

      <x-jet-button class="ml-2" wire:click="okay" wire:loading.attr="disabled">
        Okay
      </x-jet-button>
    </x-slot>
  </x-jet-dialog-modal>

</div>