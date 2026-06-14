<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_users.title') }}
    </x-slot>

    <h1>{{ __('admin_users.title') }}</h1>

    <table>
        <thead>
            <tr>
                <th>{{ __('admin_users.phone') }}</th>
                <th>{{ __('admin_users.since') }}</th>
                <th>{{ __('admin_users.status') }}</th>
                <th>{{ __('admin_users.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->phone }}</a>
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>{{ $user->trashed() ? __('admin_users.deleted') : __('admin_users.active') }}</td>
                    <td>
                        @if($user->trashed())
                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit">{{ __('admin_users.restore') }}</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ __('admin_users.delete') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</x-layouts.app>