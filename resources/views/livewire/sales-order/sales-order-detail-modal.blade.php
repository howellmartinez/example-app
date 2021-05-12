<div>
  <x-jet-dialog-modal wire:model="show">
    <x-slot name="title">
      Sales Order Detail
    </x-slot>

    <x-slot name="content">
      <div class="mt-4">
        <select for="productId" wire:model="productId">
          <option id="0" value="{{ null }}" selected></option>
          @foreach($products as $product)
          <option id="{{ $product->id }}" value="{{ $product->id }}">
            {{ $product->name }}
          </option>
          @endforeach
        </select>
        <x-jet-input-error for="quantity" class="mt-2" />

        <x-jet-label for="quantity" value="Quantity" />
        <x-jet-input type="number" wire:model.lazy="quantity" />
        <x-jet-input-error for="quantity" class="mt-2" />

        <x-jet-label for="unitPrice" value="Unit Price" />
        <x-jet-input type="number" wire:model.lazy="unitPrice" />
        <x-jet-input-error for="unitPrice" class="mt-2" />

        <x-jet-label for="lineTotal" value="Line Total" />
        <x-jet-input type="number" readonly value="{{ $this->quantity * $this->lineTotal }}" />

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