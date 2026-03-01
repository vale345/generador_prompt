<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PromptMagico</title>
    <script src='https://cdn.tailwindcss.com'></script>
    <script defer src='https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js'></script>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
</head>
<body class='bg-slate-900 text-white min-h-screen'>
    <main class='max-w-3xl mx-auto px-4 py-10'>
        @yield('content')
    </main>
</body>
</html>
