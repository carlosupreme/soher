<!DOCTYPE html>
<html lang="es" x-cloak x-data="{darkMode: localStorage.getItem('dark') === 'true'}"
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))" :class="{'dark': darkMode}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SOHER | Confianza en cada tarea</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Styles -->
  @livewireStyles
</head>

<body class="font-sans antialiased">
<x-banner/>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
  @livewire('navigation-menu')

  <main>
    {{ $slot }}
  </main>
</div>

@stack('modals')
@stack('scripts')

@livewireScripts
</body>

</html>
