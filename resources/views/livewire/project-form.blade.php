<div>
    <form wire:submit.prevent="create">
        <input type="text" wire:model="name">
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" wire:model="client">
        <input type="text" wire:model="description">
        <button type="button" wire:click="addStage">ADD STAGE</button>
        @foreach($stages as $index => $stage)
            <input type="text" wire:model="stages.{{ $index }}.description">
        @endforeach
        <button type="submit">GO</button>
    </form>
</div>
