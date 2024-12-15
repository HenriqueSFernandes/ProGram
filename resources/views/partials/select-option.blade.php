@props(['name', 'option', 'form', 'multi' => false, 'selected' => false])

<label class="select-option">
    <input type="{{ $multi ? 'checkbox' : 'radio' }}" name="{{ $name }}" value="{{ $option->id }}" form="{{ $form }}" @checked($selected)>
    <span>{{ $option->name }}</span>
</label>