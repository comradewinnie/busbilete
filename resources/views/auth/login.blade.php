<x-layouts.app>
    <x-slot name="title">
        Ieiet
    </x-slot>

    <form method="POST" action="{{ route('login') }}">
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
            <label for="remember">Atcerēties mani</label>
            <input type="checkbox" id="remember" name="remember">
        </div>

        <button type="submit">Ieiet</button>

        <a href="{{ route('register') }}">Nav konta? Reģistrēties</a>
    </form>
</x-layouts.app>