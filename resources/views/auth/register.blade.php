<x-layouts.app>
    <x-slot name="title">
        Reģistrēties
    </x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="phone">Telefona numurs</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required autofocus>
        </div>

        <div>
            <label for="password">Parole</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Apstiprināt paroli</label>
            <input type="password" id="password_confirmation"
                   name="password_confirmation" required>
        </div>

        <button type="submit">Reģistrēties</button>

        <a href="{{ route('login') }}">Jau ir konts? Ieiet</a>
    </form>
</x-layouts.app>