<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

    @if(!empty($description))
        <meta name='description' content='{{ $description }}'>
    @endif

    @vite(['resources/css/app.blade.css', 'resources/views/layouts/js/app.js'])

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
        } else {
            document.querySelector('html').classList.add('dark');
        }
        document.querySelector('html').classList.remove('dark');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T79YPDGG2G"></script>


    @include('layouts.analytics')

</head>

<body class="font-inter antialiased bg-slate-100 text-slate-600 dark:bg-slate-900 dark:text-slate-200">

<!-- Page wrapper -->
<div class="flex h-screen overflow-hidden">

    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

        @include('layouts.header')

        <main>

            <div class="w-full">
                {{ $slot }}
            </div>

        </main>

        @include('layouts.footer')

    </div>
</div>
</body>
</html>
