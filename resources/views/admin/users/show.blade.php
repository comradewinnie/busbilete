<x-layouts.app>
    <x-slot name="title">
        Lietotājs ar tel.nr. {{ $user->phone }}
    </x-slot>

    <h1>Telefons: {{ $user->phone }}</h1>
    <p>Loma: {{ $user->role }}</p>
    <p>Reģistrēts: {{ $user->created_at->format('d.m.Y') }}</p>
    <p>Statuss: {{ $user->trashed() ? 'Dzēsts' : 'Aktīvs' }}</p>

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