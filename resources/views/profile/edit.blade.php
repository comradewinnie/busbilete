<x-layouts.app>
    <x-slot name="title">
        Rediģēt profilu
    </x-slot>

    <h1>Rediģēt profilu</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="phone">Telefona numurs</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div>
            <label for="current_password">Pašreizējā parole</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div>
            <label for="password">Jaunā parole (neobligāti)</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">Jaunā parole vēlreiz</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit">Saglabāt</button>
        <a href="{{ route('profile.show') }}">Atcelt</a>
    </form>
</x-layouts.app>