<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body>
    <x-navbar />

    <main class="container mt-4">
        <x-alert />
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>