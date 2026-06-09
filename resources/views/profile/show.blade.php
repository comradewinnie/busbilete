<x-layouts.app>
    <x-slot name="title">
        Profils
    </x-slot>

    <h1>Profils</h1>

    <p><strong>Telefons:</strong> {{ $user->phone }}</p>
    <p><strong>Reģistrēts:</strong> {{ $user->created_at->format('d.m.Y') }}</p>

    <a href="{{ route('profile.edit') }}">Rediģēt profilu</a>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Vai tiešām vēlaties dzēst kontu?')">Dzēst kontu</button>
    </form>
</x-layouts.app>