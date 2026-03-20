@props([
    'name' => 'required',
])

@error($name)
    <div style="color: red; margin-bottom: 1em;">
        {{ $message }}
    </div>
@enderror