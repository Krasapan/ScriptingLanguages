<div>
    <label for="name">Ім'я гравця</label>
    <input id="name" name="name" type="text" value="{{ old('name', $betaTester->name ?? '') }}">
    @error('name')<p class="error" style="color: red;">{{ $message }}</p>@enderror
</div>

<div>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ old('email', $betaTester->email ?? '') }}">
    @error('email')<p class="error" style="color: red;">{{ $message }}</p>@enderror
</div>

<div>
    <label for="age">Вік</label>
    <input id="age" name="age" type="number" min="12" max="100" value="{{ old('age', $betaTester->age ?? 18) }}">
    @error('age')<p class="error" style="color: red;">{{ $message }}</p>@enderror
</div>

<div>
    <label for="platform">Платформа</label>
    <input id="platform" name="platform" type="text" value="{{ old('platform', $betaTester->platform ?? 'PC') }}">
    @error('platform')<p class="error" style="color: red;">{{ $message }}</p>@enderror
</div>

<div>
    <label for="experience">Ігровий досвід / Коментар</label>
    <textarea id="experience" name="experience" rows="3">{{ old('experience', $betaTester->experience ?? '') }}</textarea>
    @error('experience')<p class="error" style="color: red;">{{ $message }}</p>@enderror
</div>
