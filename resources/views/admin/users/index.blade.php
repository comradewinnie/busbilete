<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_users.title') }}
    </x-slot>

    <h1 class="fw-bold text-danger mb-4 fs-2">{{ __('admin_users.title') }}</h1>

    <div class="card border-0 shadow-sm overflow-hidden mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">{{ __('admin_users.phone') }}</th>
                        <th>{{ __('admin_users.role') }}</th>
                        <th>{{ __('admin_users.since') }}</th>
                        <th>{{ __('admin_tickets.status') }}</th>
                        <th class="pe-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $user->phone }}</td>
                            <td>
                                <span class="badge {{ $user->isAdmin() ? 'bg-danger' : 'bg-secondary' }} fw-medium">{{ $user->role }}</span>
                            </td>
                            <td class="text-muted small">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $user->trashed() ? 'bg-secondary' : 'bg-success' }} fw-medium">{{ $user->trashed() ?  __('admin_users.deleted') : __('admin_users.active') }}</span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-danger btn-sm fw-bold px-3">{{ __('admin_users.view') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</x-layouts.app>