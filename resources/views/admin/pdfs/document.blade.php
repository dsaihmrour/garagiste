<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>This PDF document is generated using domPDF in Laravel.</p>
    <img src="{{ public_path('/assets/images/logo-img.png') }}" alt="image-example">
</body>

</html>
