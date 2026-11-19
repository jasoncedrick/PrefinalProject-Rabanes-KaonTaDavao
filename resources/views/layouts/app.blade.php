<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaon Ta! Davao – Rabanes's Food Guide</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-orange-50 text-stone-900">
    <header class="border-b border-orange-200 bg-white">
        <div class="mx-auto max-w-6xl px-5 py-5">
            <p class="mb-3 text-xl font-bold text-green-900">Kaon Ta! Davao – Rabanes's Food Guide</p>
            @include('partials.nav')
        </div>
    </header>
    <main class="mx-auto max-w-6xl space-y-5 px-5 py-8">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>
