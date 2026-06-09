<x-layouts.app>
    <x-slot name="title">
        Lietotājs ar tel.nr. {{ $user->phone }}
    </x-slot>

    <h1>{{ $user->phone }}</h1>
    <p><strong>Loma:</strong> {{ $user->role }}</p>
    <p><strong>Reģistrēts:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
    <p><strong>Statuss:</strong> {{ $user->trashed() ? 'Dzēsts' : 'Aktīvs' }}</p>

    @if($user->trashed())
        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit">Atjaunot</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Dzēst</button>
        </form>
    @endif

    <a href="{{ route('admin.users.index') }}">Atpakaļ</a>
</x-layouts.app>