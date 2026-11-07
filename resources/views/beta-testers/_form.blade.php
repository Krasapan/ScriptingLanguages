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

<hr style="margin: 20px 0;">
<h3>Досвід тестувальника (Локалізації)</h3>

{{-- Динамічний цикл по мовах --}}
@foreach(\App\Models\BetaTester::AVAILABLE_LOCALES as $localeCode => $localeName)
    @php
        // Вважаємо 'uk' основною мовою, яка зберігається в таблиці beta_testers
        $isPrimary = ($localeCode === 'uk');

        // Якщо мова основна - пишемо в поле 'experience', інакше - в масив 'translations'
        $fieldName = $isPrimary ? 'experience' : "translations[{$localeCode}]";

        // Отримуємо значення для поля
        $fieldValue = $isPrimary
            ? old('experience', $betaTester->experience ?? '')
            : old("translations.{$localeCode}", $betaTester->translations->where('locale', $localeCode)->first()?->experience ?? '');

        // Формуємо підпис
        $labelText = $isPrimary ? $localeName . ' (Основна мова)' : $localeName;
    @endphp

    <div style="margin-bottom: 15px;">
        <label for="experience_{{ $localeCode }}">{{ $labelText }}</label>
        <textarea
            id="experience_{{ $localeCode }}"
            name="{{ $fieldName }}"
            rows="3"
            style="width: 100%;
                   background-color: #f8f9fa;
                   border: 1px solid #ced4da;
                   color: #333;
                   padding: 10px;
                   border-radius: 4px;
                   box-sizing: border-box;
                   font-family: inherit;"
        >{{ $fieldValue }}</textarea>

        @error($isPrimary ? 'experience' : "translations.{$localeCode}")
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
@endforeach

<hr style="margin: 20px 0;">
<h3>Призначені ігри</h3>

<div style="margin-bottom: 15px;">
    <label for="games">Оберіть ігри для тестування</label>
    <select id="games" name="games[]" multiple style="width: 100%;">
        @foreach ($games as $id => $title)
            <option value="{{ $id }}" @selected(in_array($id, old('games', $selectedGames ?? [])))>
                {{ $title }}
            </option>
        @endforeach
    </select>
    @error('games') <p class="error" style="color:red">{{ $message }}</p> @enderror
</div>
