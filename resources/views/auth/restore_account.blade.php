<x-layouts.app>
    <x-slot name="title">
        Konta atjaunošana
    </x-slot>

    <h1>Konta atjaunošana</h1>
    <p>Jūsu konts ar telefona numuru <strong>{{ $user->phone }}</strong> bija dzēsts.</p>

    @if($daysLeft > 0)
        <p>Jums ir palikušas <strong>{{ $daysLeft }}</strong> dienas, lai atjaunotu savu kontu.</p>
        <p>Pēc tam visi dati tiks neatgriezeniski dzēsti.</p>
    @else
        <p>Šī ir pēdējā diena, kad varat atjaunot savu kontu.</p>
        <p>Pēc tam visi dati tiks neatgriezeniski dzēsti.</p>
    @endif

    <form action="{{ route('account.restore') }}" method="POST">
        @csrf
        <button type="submit">Atjaunot</button>
    </form>

    <form action="{{ route('account.restore.cancel') }}" method="POST">
        @csrf
        <button type="submit">Atcelt</button>
    </form>
</x-layouts.app>