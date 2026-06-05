<x-layouts.app>
    <x-slot name="title">
        Administratora panelis
    </x-slot>

    <h1>Administratora panelis</h1>
    <a href="{{ route('admin.users.index') }}">Lietotāji</a>
    <a href="{{ route('admin.tickets.index') }}">Biļetes</a>
</x-layouts.app>