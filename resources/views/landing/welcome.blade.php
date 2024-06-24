<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
    <title>Garagiste</title>
</head>

<body class="text-gray-800 antialiased">
    @include('landing.partials.header')
    <main>
        @include('landing.sections.start-section')
        @include('landing.sections.section1')
        @include('landing.sections.section4')
        @include('landing.sections.section5')
    </main>
    @include('landing.partials.footer')
</body>

</html>
