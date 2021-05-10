@props(['items'])
<div>
    <select {{ $attributes }}>
        @foreach($items as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>