<x-layouts.app>
    <x-slot name="title">
        Lietotāji
    </x-slot>

    <h1>Lietotāji</h1>

    <table>
        <thead>
            <tr>
                <th>Telefons</th>
                <th>Reģistrēts</th>
                <th>Statuss</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->phone }}</a>
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>{{ $user->trashed() ? 'Dzēsts' : 'Aktīvs' }}</td>
                    <td>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</x-layouts.app>