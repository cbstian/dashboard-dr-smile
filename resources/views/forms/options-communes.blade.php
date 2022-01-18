@forelse ($communes as $c)
    <option value="{{ $c->id }}">{{ $c->commune }}</option>
@empty
    <option value="0">Seleccione una región...</option>
@endforelse
