<div style="margin-bottom: 15px;">
    <label for="filter_name" style="display: block; margin-bottom: 5px;">Назва мітки</label>
    <input
        type="text"
        id="filter_name"
        name="filter_name"
        value="{{ old('filter_name', $filter->filter_name ?? '') }}"
        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
    >
    @error('filter_name')
    <p class="error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="filter_description" style="display: block; margin-bottom: 5px;">Опис (необов'язково)</label>
    <textarea
        id="filter_description"
        name="filter_description"
        rows="3"
        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
    >{{ old('filter_description', $filter->filter_description ?? '') }}</textarea>
    @error('filter_description')
    <p class="error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
    @enderror
</div>
